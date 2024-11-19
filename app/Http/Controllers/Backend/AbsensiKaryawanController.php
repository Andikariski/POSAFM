<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AbsensiKaryawan;
use App\Models\User;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TimeHelper;

class AbsensiKaryawanController extends Controller
{
    public function index()
    {
        // tanggal dan jam hari ini
        Carbon::setLocale('id');
        $date = Carbon::now();
        $tanggalHariIni = $date->translatedFormat('d F Y');
        $jamSaatIni = TimeHelper::getCurrentHour();

        // jumlah karyawan
        $karyawan = User::all()->where('is_admin', false)->count();

        // data absensi semua karyawan hari ini
        $dataAbsensiKaryawanAll = AbsensiKaryawan::with('karyawan')->whereDate('created_at', Carbon::now()->toDateString())->get();
        try {
            $user = auth()->user(); // Make sure to get the authenticated user

            if ($user) {
                $dataAbsensiKaryawan = AbsensiKaryawan::with('karyawan')
                    ->whereDate('created_at', Carbon::now()->toDateString())
                    ->where('fkid_user', $user->id)
                    ->get();
                if ($user->is_admin) {
                    return view('Backend.pages.absensiAdminView', compact('tanggalHariIni', 'karyawan', 'jamSaatIni', 'dataAbsensiKaryawanAll'));
                }
                return view('Backend.pages.absensiKaryawanView', compact('tanggalHariIni', 'jamSaatIni', 'dataAbsensiKaryawan'));
            } else {
                return redirect('login');
            }
        } catch (\Exception $exception) {
            return response()->view('errors.419', [], 419);
        }
    }

    // menyimpan record absensi karyawan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fkid_user' => 'required|exists:users,id',
            'type' => 'required|in:masuk_pagi,keluar_siang,masuk_siang,keluar_sore',
            'time' => 'required|date_format:H:i'
        ]);

        $now = now();
        $record = AbsensiKaryawan::firstOrCreate([
            'fkid_user' => $validated['fkid_user'],
            'tanggal_absen' => $now->toDateString()
        ]);

        //konfigurasi absen
        $konfigAbsensi = [
            'masuk_pagi' => [
                'order' => 0,
                'start_time' => '07:00',
                'end_time' => '10:00'
            ],
            'keluar_siang' => [
                'order' => 1,
                'start_time' => '12:00',
                'end_time' => '13:00'
            ],
            'masuk_siang' => [
                'order' => 2,
                'start_time' => '13:00',
                'end_time' => '16:00'
            ],
            'keluar_sore' => [
                'order' => 3,
                'start_time' => '17:00',
                'end_time' => '20:00'
            ],
        ];

        $currentType = $validated['type'];
        $currentOrder = $konfigAbsensi[$currentType]['order'];

        //prepare update data
        $updateData = [];
        //process absensi sebelumnya yang tidak terisi (tidak hadir)
        foreach ($konfigAbsensi as $type => $config) {
            if ($config['order'] < $currentOrder) {
                if (is_null($record->{$type}) || $record->{$type . '_status'} === 'belum_absen') {
                    $updateData[$type . '_status'] = 'tidak_hadir';
                }
            }
        }

        // menentukan status kehadiran (terlambat, tepat waktu, dll)
        $status = $this->menghitungStatusKeterlambatan($validated['type'], $validated['time']);

        // menambahkan data absen saat ini
        $updateData[$currentType] = $validated['time'];
        $updateData[$currentType . '_status'] = $status;

        // menyimpan ke database
        try {
            DB::beginTransaction();
            //update data
            $record->update($updateData);
            DB::commit();

            return response()->json([
                'message' => 'Berhasil Melakukan Absen',
                'status' => $status
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'gagal melakukan absen',
                'error' => $e->getMessage()
            ]);
        }
    }

    // update data table absensi dengan ajax
    public function getDataAbsensiUpdated()
    {
        $jamSaatIni = TimeHelper::getCurrentHour();
        $query = AbsensiKaryawan::with('karyawan')
            ->whereDate('created_at', Carbon::now()->toDateString());
        if (!auth()->user()->is_admin) {
            $query->where('fkid_user', auth()->id());
        }

        $dataAbsensiKaryawan = $query->get();
        return view('Backend.components.tabelAbsensiKaryawan', compact('dataAbsensiKaryawan', 'jamSaatIni'));
    }

    // get report data absensi bulanan karyawan
    public function getDataAbsensiBulanan(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));

        try {
            $user = auth()->user();

            if ($user) {
                $absensiRecords = AbsensiKaryawan::latest()->with('karyawan')
                    ->whereYear('tanggal_absen', $year)
                    ->whereMonth('tanggal_absen', $month)
                    ->get()
                    ->groupBy('fkid_user');

                $laporanAbsensi = [];
                if ($absensiRecords->isNotEmpty()) {
                    foreach ($absensiRecords as $employeeId => $records) {
                        $laporanAbsensi[] = [
                            'nama_karyawan' => $records->first()->karyawan->name,
                            'total_hari' => $records->count(),
                            // Masuk Pagi Statistics
                            'masuk_pagi' => [
                                'tepat_waktu' => $records->where('masuk_pagi_status', 'tepat_waktu')->count(),
                                'terlambat' => $records->where('masuk_pagi_status', 'terlambat')->count(),
                                'tidak_hadir' => $records->where('masuk_pagi_status', 'tidak_hadir')->count(),
                                'sakit' => $records->where('masuk_pagi_status', 'sakit')->count(),
                            ],
                            // Keluar Siang Statistics
                            'keluar_siang' => [
                                'tepat_waktu' => $records->where('keluar_siang_status', 'tepat_waktu')->count(),
                                'terlambat' => $records->where('keluar_siang_status', 'terlambat')->count(),
                                'tidak_hadir' => $records->where('keluar_siang_status', 'tidak_hadir')->count(),
                                'sakit' => $records->where('keluar_siang_status', 'sakit')->count(),
                            ],
                            // Masuk Siang Statistics
                            'masuk_siang' => [
                                'tepat_waktu' => $records->where('masuk_siang_status', 'tepat_waktu')->count(),
                                'terlambat' => $records->where('masuk_siang_status', 'terlambat')->count(),
                                'tidak_hadir' => $records->where('masuk_siang_status', 'tidak_hadir')->count(),
                                'sakit' => $records->where('masuk_siang_status', 'sakit')->count(),
                            ],
                            // Keluar Sore Statistics
                            'keluar_sore' => [
                                'tepat_waktu' => $records->where('keluar_sore_status', 'tepat_waktu')->count(),
                                'terlambat' => $records->where('keluar_sore_status', 'terlambat')->count(),
                                'tidak_hadir' => $records->where('keluar_sore_status', 'tidak_hadir')->count(),
                                'sakit' => $records->where('keluar_sore_status', 'sakit')->count(),
                            ],
                            'records' => $records
                        ];
                    }
                }

                return view('Backend.pages.absensiKaryawanBulanan', compact('laporanAbsensi'));
            } else {
                return redirect('login');
            }
        } catch (\Exception $exception) {
            return response()->view('errors.419', [], 419);
        }
    }

    // UTILITY FUNCTION
    //menghitung status keterlambatan
    private function menghitungStatusKeterlambatan($type, $time)
    {
        $timeObj = Carbon::createFromFormat('H:i', $time);

        switch ($type) {
            case 'masuk_pagi':
                return $timeObj->lt('07:00') ? 'tepat_waktu' : 'terlambat';
            case 'keluar_siang':
                return $timeObj->between('12:00', '12:59') ? 'tepat_waktu' : 'terlambat';
            case 'masuk_siang':
                return $timeObj->lt('13:00') ? 'tepat_waktu' : 'terlambat';
            case 'keluar_sore':
                return $timeObj->between('17:00', '20:00') ? 'tepat_waktu' : 'terlambat';
        }
    }
}

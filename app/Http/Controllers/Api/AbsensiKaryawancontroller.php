<?php

namespace App\Http\Controllers\Api;

use App\Models\AbsensiKaryawan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TimeHelper;

class AbsensiKaryawancontroller extends BaseController
{
    public function index()
    {
        // tanggal dan jam hari ini
        Carbon::setLocale('id');
        $date = Carbon::now();
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
                    return $this->sendResponse($dataAbsensiKaryawanAll, 'berhasil mengambil data semua karyawan');
                }
                return $this->sendResponse($dataAbsensiKaryawan, 'berhasil mengambil data absensi kamu');
            } else {
                return $this->sendError('unauthorized');
            }
        } catch (\Exception $exception) {
            return $this->sendError('gagal mengambil data absensi');
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate request
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

            // Attendance configuration
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

            // Prepare update data
            $updateData = [];

            // Process previous unrecorded attendance
            foreach ($konfigAbsensi as $type => $config) {
                if ($config['order'] < $currentOrder) {
                    if (is_null($record->{$type}) || $record->{$type . '_status'} === 'belum_absen') {
                        $updateData[$type . '_status'] = 'tidak_hadir';
                    }
                }
            }

            // Calculate attendance status
            $status = $this->menghitungStatusKeterlambatan($validated['type'], $validated['time']);

            // Add current attendance data
            $updateData[$currentType] = $validated['time'];
            $updateData[$currentType . '_status'] = $status;

            // Save to database
            DB::beginTransaction();
            $record->update($updateData);
            DB::commit();

            $data = ['absensi' => $record->fresh()];

            return $this->sendResponse($data, 'berhasil melakukan absen');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->sendError('validasi data gagal');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('gagal melakukan absen');
        }
    }

    public function getDataAbsensiBulanan(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));

        try {
            $user = auth()->user();

            if ($user->is_admin) {
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

                return $this->sendResponse($laporanAbsensi, 'berhasil mengambil data absen bulanan karyawan');
            }

            if (!$user->is_admin) {
                $absensiRecords = AbsensiKaryawan::latest()->with('karyawan')
                    ->whereYear('tanggal_absen', $year)
                    ->whereMonth('tanggal_absen', $month)
                    ->where('fkid_user', $user->id)
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

                return $this->sendResponse($laporanAbsensi, 'berhasil mengambil data absen bulanan karyawan');
            } else {
                return $this->sendError('unauthorized');
            }
        } catch (\Exception $exception) {
            return $this->sendError('gagal mengambil data absensi bulanan');
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

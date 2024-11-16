<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AbsensiKaryawan;
use App\Models\User;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;

class AbsensiKaryawanController extends Controller
{
    public function index()
    {
        // tanggal hari ini
        Carbon::setLocale('id');
        $date = Carbon::now();
        $tanggalHariIni = $date->translatedFormat('d F Y');

        // jumlah karyawan
        $karyawan = User::all()->where('is_admin', false)->count();

        // data absensi semua karyawan hari ini
        $user = auth()->user();
        $dataAbsensiKaryawanAll = AbsensiKaryawan::with('karyawan')->whereDate('created_at', Carbon::now()->toDateString())->get();
        try {
            $user = auth()->user(); // Make sure to get the authenticated user

            if ($user) {
                $dataAbsensiKaryawan = AbsensiKaryawan::with('karyawan')
                    ->whereDate('created_at', Carbon::now()->toDateString())
                    ->where('fkid_user', $user->id)
                    ->get();

                if ($user->is_admin) {
                    return view('Backend.pages.absensiAdminView', compact('tanggalHariIni', 'karyawan', 'dataAbsensiKaryawanAll'));
                }
                return view('Backend.pages.absensiKaryawanView', compact('tanggalHariIni', 'dataAbsensiKaryawan'));
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
            'time' => 'required|date_format:H:i',
        ]);

        $now = now();
        $record = AbsensiKaryawan::firstOrCreate([
            'fkid_user' => $validated['fkid_user'],
            'tanggal_absen' => $now->toDateString(),
        ]);

        $status = $this->menghitungStatusKeterlambatan($validated['type'], $validated['time']);

        $record->update([
            $validated['type'] => $validated['time'],
            $validated['type'] . '_status' => $status
        ]);

        return response()->json(['message' => 'Attendance recorded', 'status' => $status]);
    }

    // UTILITY FUNCTION
    // update data table absensi dengan ajax
    public function getDataAbsensiUpdated()
    {
        $dataAbsensiKaryawan = AbsensiKaryawan::with('karyawan')->whereDate('created_at', Carbon::now()->toDateString())->get();
        return view('Backend.components.tabelAbsensiKaryawan', compact('dataAbsensiKaryawan'));
    }

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
                return $timeObj->between('17:00', '00:00') ? 'tepat_waktu' : 'terlambat';
        }
    }
}

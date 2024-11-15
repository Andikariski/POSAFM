<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AbsensiKaryawan;
use App\Models\User;
use Carbon\Carbon;
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
        $dataAbsensiKaryawan = AbsensiKaryawan::with('karyawan')->whereDate('created_at', Carbon::now()->toDateString())->where('fkid_user', $user->id)->get();

        if (auth()->user()->is_admin) {
            return view('Backend.pages.absensiAdminView', compact('tanggalHariIni', 'karyawan', 'dataAbsensiKaryawanAll'));
        }
        return view('Backend.pages.absensiKaryawanView', compact('tanggalHariIni', 'karyawan', 'dataAbsensiKaryawan'));
    }
    public function show()
    {
        return view('Backend.pages.detailAbsensiKaryawan');
    }
}

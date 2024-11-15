@extends('layouts.main')
@section('container')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-success p-4 mr-3 rounded-circle" style="opacity: 0.5;">
                                    <i data-feather="users" class="feather-icon" width="32" height="32"
                                        color="white"></i>
                                </div>
                                <div>
                                    <p>Jumlah Karyawan</p>
                                    <h1>{{ $karyawan }} Orang</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="bg-info p-4 mr-3 rounded-circle" style="opacity: 0.5;">
                                    <i data-feather="calendar" class="feather-icon" width="40" height="40"
                                        color="white"></i>
                                </div>
                                <div>
                                    <p>Hari Ini</p>
                                    <h1>{{ $tanggalHariIni }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white card">
                <p class="text-white card-header bg-secondary">Data Absen Karyawan Hari Ini</p>
                <div class="table-responsive-lg overflow-hidden">
                    <div class="px-4 d-flex align-items-center">
                        <div class="d-flex align-items-center mr-4">
                            <div class="bg-success" style="width: 12px; height:12px; border-radius: 2px;"></div>
                            <p class="mt-3 ml-2">tepat waktu</p>
                        </div>
                        <div class="d-flex align-items-center mr-4">
                            <div class="bg-warning" style="width: 12px; height:12px; border-radius: 2px;"></div>
                            <p class="mt-3 ml-2">terlambat</p>
                        </div>
                        <div class="d-flex align-items-center mr-4">
                            <div class="bg-danger" style="width: 12px; height:12px; border-radius: 2px;"></div>
                            <p class="mt-3 ml-2">tidak hadir</p>
                        </div>
                        <div class="d-flex align-items-center mr-4">
                            <div class="bg-secondary" style="width: 12px; height:12px; border-radius: 2px;"></div>
                            <p class="mt-3 ml-2">belum absen</p>
                        </div>
                    </div>
                    <table class="table mx-4 mt-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Masuk Pagi 07:00</th>
                                <th>Keluar Siang 12:00</th>
                                <th>Masuk Siang 13:00</th>
                                <th>Keluar Sore 17:00</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataAbsensiKaryawanAll as $item)
                                <tr>
                                    <td>{{ $item->karyawan->name }}</td>
                                    <td>
                                        <input type="checkbox" {{ $item->masuk_pagi ? 'checked' : '' }}
                                            onclick="return false;">
                                        @if ($item->masuk_pagi_status === 'belum_absen')
                                            <label class="ml-2 text-secondary">belum absen</label>
                                        @elseif($item->masuk_pagi_status === 'tidak_hadir')
                                            <label class="ml-2 text-danger">tidak hadir</label>
                                        @elseif($item->masuk_pagi_status === 'terlambat')
                                            <label
                                                class="ml-2 text-warning">{{ \Carbon\Carbon::parse($item->masuk_pagi)->format('H : i') }}</label>
                                        @else
                                            <label
                                                class="ml-2 text-success">{{ \Carbon\Carbon::parse($item->masuk_pagi)->format('H : i') }}</label>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $item->keluar_siang ? 'checked' : '' }}
                                            onclick="return false;">
                                        @if ($item->keluar_siang_status === 'belum_absen')
                                            <label class="ml-2 text-secondary">belum absen</label>
                                        @elseif($item->keluar_siang_status === 'tidak_hadir')
                                            <label class="ml-2 text-danger">tidak hadir</label>
                                        @elseif($item->keluar_siang_status === 'terlambat')
                                            <label
                                                class="ml-2 text-warning">{{ \Carbon\Carbon::parse($item->keluar_siang)->format('H : i') }}</label>
                                        @else
                                            <label
                                                class="ml-2 text-success">{{ \Carbon\Carbon::parse($item->keluar_siang)->format('H : i') }}</label>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $item->masuk_siang ? 'checked' : '' }}
                                            onclick="return false;">
                                        @if ($item->masuk_siang_status === 'belum_absen')
                                            <label class="ml-2 text-secondary">belum absen</label>
                                        @elseif($item->masuk_siang_status === 'tidak_hadir')
                                            <label class="ml-2 text-danger">tidak hadir</label>
                                        @elseif($item->masuk_siang_status === 'terlambat')
                                            <label
                                                class="ml-2 text-warning">{{ \Carbon\Carbon::parse($item->masuk_siang)->format('H : i') }}</label>
                                        @else
                                            <label
                                                class="ml-2 text-success">{{ \Carbon\Carbon::parse($item->masuk_siang)->format('H : i') }}</label>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" {{ $item->keluar_sore ? 'checked' : '' }}
                                            onclick="return false;">
                                        @if ($item->keluar_sore_status === 'belum_absen')
                                            <label class="ml-2 text-secondary">belum absen</label>
                                        @elseif($item->keluar_sore_status === 'tidak_hadir')
                                            <label class="ml-2 text-danger">tidak hadir</label>
                                        @elseif($item->keluar_sore_status === 'terlambat')
                                            <label
                                                class="ml-2 text-warning">{{ \Carbon\Carbon::parse($item->keluar_sore)->format('H : i') }}</label>
                                        @else
                                            <label
                                                class="ml-2 text-success">{{ \Carbon\Carbon::parse($item->keluar_sore)->format('H : i') }}</label>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

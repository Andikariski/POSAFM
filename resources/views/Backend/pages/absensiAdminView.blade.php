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
                <div class="table-responsive px-4 mt-2">
                    <div class="d-flex align-items-center">
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
                    @include('Backend.components.tabelAbsensiKaryawanAll')
                </div>
            </div>
        </div>
    </div>
@endsection

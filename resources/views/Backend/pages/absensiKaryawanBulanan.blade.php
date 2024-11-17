@extends('layouts.main')
@section('container')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card">
                <h4 class="card-header bg-secondary text-white">Laporan Absensi Bulanan Karyawan</h4>
                <div class="card-body">
                    {{-- Filter Form --}}
                    <form method="GET" action="{{ route('absensi-karyawan-bulanan') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="month" class="form-control">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}"
                                            {{ request('month', date('n')) == $i ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($i)->isoFormat('MMMM') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="year" class="form-control">
                                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                        <option value="{{ $i }}"
                                            {{ request('year', date('Y')) == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>

                    {{-- Table --}}
                    <div class="table-responsive">
                        @include('Backend.components.tabelAbsensiKaryawanBulanan')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

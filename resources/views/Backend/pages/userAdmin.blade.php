@extends('layouts.main')
@section('container')
@include('layouts.swetalert')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Halaman {{ $headPage }}</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dataPelanggan') }}">Admin / {{ $headPage }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    {{-- <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                        <option selected>Aug 19</option>
                    </select> --}}
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">
                        {{-- {{ \Carbon\Carbon::createFromFormat('Y-m-d', date('Y'))->locale('id_ID')->isoFormat('D MMMM YYYY') }} --}}
                        {{-- {{ date("F j, Y") }} --}}
                        <button type="button" class="btn btn-info btn-add">Tambah Pelanggan</button>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <!-- Container fluid  -->
    <!-- order table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar {{ $headPage }}</h4>
                    <h6 class="card-subtitle">Data pelanggan digunakan untuk keperluan pembelian token listrik, pulsa HP dan Kasbond.</h6>
                    <div class="table-responsive">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>


<script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
@endsection
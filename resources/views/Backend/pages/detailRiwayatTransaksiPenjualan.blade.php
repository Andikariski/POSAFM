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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ $headPage }}</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dataProduk') }}">Admin / {{ $headPage }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">
                        <a href="{{ route('riwayatTransaksiPenjualan') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4">
                                    <label for="inputPassword6" class="col-form-label">Nomor Faktur</label>
                                </div>
                                <div class="col-8">
                                    <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ $dataTransaksi->faktur }}</strong></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="inputPassword6" class="col-form-label">Kasir</label>
                                </div>
                                <div class="col-8">
                                    <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ $dataTransaksi->kasir->name }}</strong></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="inputPassword6" class="col-form-label">Tanggal</label>
                                </div>
                                <div class="col-8">
                                    {{-- <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ $dataTransaksi->tanggal }}</strong></label> --}}
                                    <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ Carbon\Carbon::createFromFormat('Y-m-d', $dataTransaksi->tanggal)->isoFormat('D MMMM YYYY') }}</strong></label>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row ml-4">
                                <div class="col-4">
                                    <label for="inputPassword6" class="col-form-label">Pelanggan</label>
                                </div>
                                <div class="col-8">
                                    <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ $dataTransaksi->pelanggan->nama_pelanggan }}</strong></label>
                                </div>
                            </div>
                            <div class="row ml-4">
                                <div class="col-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat</label>
                                </div>
                                <div class="col-8">
                                    <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ $dataTransaksi->pelanggan->alamat->alamat_detail }}</strong></label>
                                </div>
                            </div>
                            <div class="row ml-4">
                                <div class="col-4">
                                    <label for="inputPassword6" class="col-form-label">Status Transaksi</label>
                                </div>
                                <div class="col-8">
                                    <label for="inputPassword6" class="col-form-label">:
                                            @if($dataTransaksi->total_pembayaran <= $dataTransaksi->uang_terbayar) 
                                                <span class="badge bg-success font-16 text-white ml-2">Lunas</span>
                                            @else
                                                <span class="badge bg-danger font-16 text-white ml-2">Belum Lunas (Rp {{ number_format($dataTransaksi->uang_terbayar - $dataTransaksi->total_pembayaran) }})</span>
                                            @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <table class="table table-bordered mt-2" style="width:100%">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>Produk</th>
                                <th>Harga Satuan Produk</th>
                                <th style="width: 20%">Jumlah Produk (Qty)</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($dataSubTransaksi as $item)    
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ strtoupper($item->produk->nama_produk) }}</td>
                                <td>{{ number_format($item->produk->harga_jual_produk) }}</td>
                                <td>{{ $item->jumlah_produk }}</td>
                                <td>{{ number_format($item->sub_total) }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-active">
                                <td colspan="3" rowspan="3" style="text-align:center; heigh"><strong >Rincian Pembayaran</strong></td>
                                <td>Total Pembayaran</td>
                                <td><strong style="color:#2AC200">Rp {{ number_format($dataTransaksi->total_pembayaran) }}</strong></td>
                            </tr>
                            <tr class="table-active">
                                <td>Uang Terbayar</td>
                                <td><strong>Rp {{ number_format($dataTransaksi->uang_terbayar) }}</strong></td>
                            </tr>
                            <tr class="table-active">
                                <td>Kembalian</td>
                                <td><strong style="color:#ff0000">Rp {{ number_format($dataTransaksi->uang_terbayar - $dataTransaksi->total_pembayaran) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="div float-right">
                        <button class="btn btn-success waves-effect waves-light" type="button">
                            <span class="btn-label"><i class="fas fa-print"></i></span>
                            Print Faktur
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
{{-- </div> --}}

{{-- Modal Ubah Data --}}
<div id="modalAction" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        {{-- Ambil dari blade action --}}
    </div>
</div>

{{-- Modal Detail Produk --}}
<div id="modalActionDetail" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        {{-- Ambil dari blade action --}}
    </div>
</div>
{{-- Modal Ubah Data End--}}

<script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
@endsection

{{-- @push('scripts')
    {{$dataTable->scripts()}}
@endpush --}}
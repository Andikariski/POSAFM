@extends('layouts.main')
@section('container')
@include('layouts.swetalert')

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                {{-- <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Halaman {{ $headPage }}</h3> --}}
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dataAlamat') }}">Admin / {{ $headPage }}</a>
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
                    {{-- <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"> --}}
                        {{-- {{ \Carbon\Carbon::createFromFormat('Y-m-d', date('Y'))->locale('id_ID')->isoFormat('D MMMM YYYY') }} --}}
                        {{-- {{ date("F j, Y") }} --}}
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Alamat</button> --}}
                    {{-- </h4> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <!-- Container fluid  -->
    <div class="row">
        <div class="col-4">
            <div class="card">
                <form class="mt-2" action="{{ route('storeDataAlamat') }}" method="POST">
                    @csrf
                <div class="card-body">
                    <h4 class="card-title">Tambah Alamat Baru</h4>
                    <h6 class="card-subtitle" style="color: red">Pastikan alamat yang diinput terdaftar di kabupaten Merauke</h6>
                    <hr>
                        <div class="form-group mt-4">
                            <label for="exampleFormControlSelect1">Masukan Alamat Baru</label>
                            <input type="text" class="form-control" placeholder="Ketik disini" name="alamat_detail" value="" required>
                        </div>
                    </div>
                    <div class="modal-footer">    
                        <button class="btn btn-primary" type="submit" id="simpan">Simpan</button>
                        <button class="btn btn-danger" type="button" id="resets">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar {{ $headPage }}</h4>
                    <h6 class="card-subtitle">Data alamat untuk wilayah tanah miring, semangga dan sekitarnya</h6>
                    <div class="table-responsive">
                        <table id="default_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="50px">No</th>
                                    <th>Alamat</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $item)    
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->alamat_detail }}</td>
                                    <td>
                                        <div class="form-button-action container" style="text-align: center">
                                            <a href="#" class="m-3" data-toggle="modal" data-placement="top"  data-target="#ubahData{{ $item->id_alamat_pelanggan }}">
                                                <i style="color:rgb(41, 228, 94)" class="fas fa-edit fa-1x" data-toggle="tooltip" data-placement="top" title="Ubah alamat"></i>
                                            </a>
                                            <a class="tombolhapus" href="{{ route('hapusDataAlamat',$item->id_alamat_pelanggan) }}">
                                                <i style="color:rgb(249, 37, 37)" class="fas fa-trash fa-1x " data-toggle="tooltip" data-placement="top" title="Hapus alamat"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
        </div>
    </div>
    </div>



<!-- Modal tambah data -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel" style="color: black"><strong>Tambah Alamat</strong></h4>
        </div>
        <div class="modal-body">
            <h6>Alamat lengkap</h6>
            <form class="mt-2" action="{{ route('storeDataAlamat') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Ketik disini" name="alamat_detail" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>


@foreach ($data as $item )
<!-- Modal ubah data -->
<div id="ubahData{{ $item->id_alamat_pelanggan }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel"style="color: black"><strong>Ubah Alamat</strong></h4>
        </div>
        <div class="modal-body">
            <h6>Alamat Lengkap</h6>
            <form class="mt-2" action="{{ route('updateDataAlamat',$item->id_alamat_pelanggan) }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $item->id_alamat_pelanggan }}" name="id">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Ketik disini" name="alamat_detail" value="{{ $item->alamat_detail }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach
@endsection
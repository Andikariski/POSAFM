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
                            <li class="breadcrumb-item"><a href="{{ route('dataPelangganPLN') }}">Admin / {{ $headPage }}</a>
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
                        {{-- <button type="button" class="btn btn-info btn-add">Tambah Pelanggan</button> --}}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <!-- Container fluid  -->
    <!-- order table -->
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Pelanggan Baru</h4>
                    <h6 class="card-subtitle" style="color: red">Pastikan Pelanggan PLN baru sudah terdaftar di Pelanggan toko</h6>
                    <hr>
                    {{-- <div id="reloadSelect">             --}}
                    <form id="formAction" action="{{ route('simpanDataPelangganPLN') }}" method="post">
                        <div class="form-group" id="reloadSelect">
                            @csrf
                            <label for="exampleFormControlSelect1">Pilih Pelanggan Toko</label>
                            <select select class="form-control addPelanggan"  style="width: 100%" id="pelanggan" name="fkid_pelanggan" required>
                                <option selected>-- Cari --</option>
                                @foreach ($dataPelanggan as $pelangganToko)
                                <option value="{{ $pelangganToko->id_pelanggan }}">{{ $pelangganToko->nama_pelanggan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="exampleFormControlSelect1">ID Pelanggan PLN</label>
                            <input type="number" class="form-control" placeholder="Ketik disini" name="nomer_pelanggan_pln" value="" required>
                        </div>
                        <button class="btn btn-primary" type="submit" id="simpan"><i class="far fa-save"></i> Simpan</button>
                        <button class="btn btn-danger" type="button" id="resets"><i class="fas fa-recycle"></i> Reset</button>
                    </form>
                {{-- </div> --}}
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar {{ $headPage }}</h4>
                    <h6 class="card-subtitle">Data pelanggan PLN Toko Andika Maros</h6>
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-striped table-bordered no-wrap dataTable']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
{{-- 

{{-- Modal Edit Pelanggan PLN --}}
<div id="modalAction" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        {{-- Ambil dari blade action --}}
    </div>
</div>

{{-- Modal Detail Pelanggan --}}
<div id="modalActionDetail" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        {{-- Ambil dari blade action --}}
    </div>
</div>
{{-- Modal Ubah Data End--}}


<script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script>
    
// Script Main
$('#simpan').on('click', function(){
        store()
})

// Script Show Modal Add data
$('.btn-add').on('click', function(){
        $('#modalAction').modal('show');
        $.ajax({
            method : 'get',
            url : `{{ url('modal-show') }}`,
            headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            success : function(res){
                $('#modalAction').find('.modal-dialog').html(res)
                console.log(res)
                $('#modalAction').modal('show');
                store()
                // console.log(data);
            }
        })
        // console.log('Add');
    })

//Script reset Form
$('#resets').on('click', function(){
    $('#formAction').trigger("reset");
    $('#reloadSelect').load(window.location.href + " #reloadSelect", function(){
            $('.addPelanggan').select2();
        })
    })

// Function Store Data
function store(){
    $('#formAction').on('submit', function(e){
                e.preventDefault()
                e.stopImmediatePropagation()
                const _form = this
                const formData = new FormData(_form)
                const url = this.getAttribute('action')
                const method = this.getAttribute('method')
                $.ajax({
                    method  : method,
                    url     : url,
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data    : formData,
                    processData : false,
                    contentType : false,
                    cache:false,
                    success : function(res){
                        Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                            })
                        window.LaravelDataTables["pelangganpln-table"].ajax.reload()
                        $('#modalAction').modal('hide');
                        $('#formAction').trigger("reset");
                        $('#pelanggan').select2('val', 'All');
                        $('#reloadSelect').load(window.location.href + " #reloadSelect", function(){
                                $('.addPelanggan').select2();
                        })
                    }
                })
                // console.log(this);
            })
        }

// Script Hapus Data
$('#pelangganpln-table').on('click','.action',function(){
        let data    = $(this).data()
        let id      = data.id
        let jenis   = data.jenis
        if(jenis == 'delete'){
            // console.log('delete');
            Swal.fire({
                title: "Anda Yakin ?",
                text: "Data yang telah dihapus tidak akan kembali lagi !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal",
                confirmButtonText: "Hapus Data"
            }).then(result => {
            if (result.value) {
                $.ajax({
                    method  : 'DELETE',
                    url     : `{{ url('hapus-data-pelanggan-pln') }}/${id}`,
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(res){
                        Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                            })
                        $('#reloadSelect').load(window.location.href + " #reloadSelect", function(){
                                $('.addPelanggan').select2();
                        })
                        window.LaravelDataTables["pelangganpln-table"].ajax.reload()
                    }
            })
            }
        });
            return
        }

        else if(jenis=='edit'){
        $.ajax({
            method : 'get',
            url : `{{ url('ubah-pelanggan-PLN') }}/${id}`,
            success : function(res){
                $('#modalAction').find('.modal-dialog').html(res)
                $('#modalAction').modal('show');
                $('#formActionEdit').on('submit', function(e){
                e.preventDefault()
                e.stopImmediatePropagation()
                const _form = this
                const formData = new FormData(_form)
                const url = this.getAttribute('action')
                const method = this.getAttribute('method')
                $.ajax({
                    method  : method,
                    url     : url,
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data    : formData,
                    processData : false,
                    contentType : false,
                    cache:false,
                    success : function(res){
                        Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                            })
                        window.LaravelDataTables["pelangganpln-table"].ajax.reload()
                        $('#modalAction').modal('hide');
                        $('#formAction').trigger("reset");
                        $('#pelanggan').select2('val', 'All');
                        $('#reloadSelect').load(window.location.href + " #reloadSelect", function(){
                                $('.addPelanggan').select2();
                        })
                    }
                })
                // console.log(this);
            })
        }
    })
    }
    else if(jenis=='detail'){
        $('#modalActionDetail').modal('show');
        $.ajax({
            method : 'get',
            url : `{{ url('detail-pelanggan-PLN') }}/${id}`,
            headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            success : function(res){
                $('#modalActionDetail').find('.modal-dialog').html(res)
                $('#modalActionDetail').modal('show');
            }
        })
        // console.log('Add');
    }
    })

    $(document).ready(function() {
            $('.addPelanggan').select2({
                maximumSelectionLength: 3
            });
        });

    // $(document).ready(function() {
    //        $('.dataTable').DataTable({
    //         "scrollX": false,
    //         "scrollY": 100,
    //        })
    //     });
    </script>
    @endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
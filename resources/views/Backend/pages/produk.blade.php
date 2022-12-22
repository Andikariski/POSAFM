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
                            <li class="breadcrumb-item"><a href="{{ route('dataProduk') }}">Admin / {{ $headPage }}</a>
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
                        {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#bs-example-modal-lg" onclick="tambahData()">Tambah Produk</button> --}}
                        <button type="button" class="btn btn-info btn-add"><i class="fas fa-plus"></i> Tambah Produk</button>
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
                    <div class="row">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-success text-center">
                                    <h2 class="font-light text-white">{{ number_format($totalProduk) }}</h2>
                                    <h6 class="text-white">Total Produk</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-success text-center">
                                    <h2 class="font-light text-white">{{ number_format($totalStokProduk) }}</h2>
                                    <h6 class="text-white">Stok Produk Kurang dari 2</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-success text-center">
                                    <h2 class="font-light text-white">{{ number_format($totalJenisProduk) }}</h2>
                                    <h6 class="text-white">Total Jenis Produk</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="p-2 bg-success text-center">
                                    <h2 class="font-light text-white">Rp {{ number_format($totalProduk) }}</h2>
                                    <h6 class="text-white">Total Produk Kosong</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <div class="div mt-2">
                            <a href="{{ route('PDF.produk') }}" class="btn btn-danger" target="_blank">
                                <i class="far fa-file-pdf"></i> Cetak PDF
                            </a>
                            <button class="btn btn-success ml-1">
                                <i class="fas fa-file-excel"></i> Cetak CSV
                            </button>
                        </div>
                            {!! $dataTable->table(['class' => 'table table-striped table-bordered no-wrap dataTable']) !!}
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
<script>
    function tambahData() {
            $('.jenisProduk').select2();
            // $('.alamat_edit').select2();
    };

    function ubahData() {
            $('.ubah_alamat').select2();
            // $('.alamat_edit').select2();
    };

      // Script Show Modal Add data
   $('.btn-add').on('click', function(){
    // console.log('Test')
        $('#modalAction').modal('show');
        $.ajax({
            method : 'get',
            url : `{{ url('modal-show-produk') }}`,
            headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            success : function(res){
                $('#modalAction').find('.modal-dialog').html(res)
                console.log(res)
                $('#modalAction').modal('show');
                store()
            }
        })
    })

      //CRUD function
      $('#produk-table').on('click','.action',function(){
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
                    url     : `{{ url('hapus-data-produk') }}/${id}`,
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(res){
                        Swal.fire({
                            icon    : res.icon,
                            title   :  res.status,
                            text    :  res.message,
                        })
                        window.LaravelDataTables["produk-table"].ajax.reload()
                    }
            })
            }
        });
            return
        }

    else if(jenis=='edit'){
        $.ajax({
            method : 'get',
            url : `{{ url('modal-ubah-produk') }}/${id}`,
            success : function(res){
                $('#modalAction').find('.modal-dialog').html(res)
                console.log(res)
                $('#modalAction').modal('show');
                store();
            }
        })
    }
    else if(jenis=='detail'){
        $('#modalActionDetail').modal('show');
        $.ajax({
            method : 'get',
            url : `{{ url('detail-produk') }}/${id}`,
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


      // Script Store Data untuk menyimpan data kedalam database selama data aman
      function store(){
            $('#formAction').on('submit', function(e){
                e.preventDefault()
                const _form = this
                const formData = new FormData(_form)
                const url = this.getAttribute('action')
            
                $.ajax({
                    method  : 'post',
                    url     : url,
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data    : formData,
                    processData : false,
                    contentType : false,
                    success : function(res){
                        Swal.fire({
                            icon    : res.icon,
                            title   :  res.status,
                            text    :  res.message,
                        })
                        window.LaravelDataTables["produk-table"].ajax.reload()
                        $('#modalAction').modal('hide');
                    }
                })
            })
        }

</script>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
@extends('layouts.main')
@section('container')
@include('layouts.swetalert')
<link href="{{ url('style/dist/css/custome.css')}}" rel="stylesheet"/>
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
<style>
    table{
        padding: 0.8px;
    }
    .bg{
        border-radius: 3px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 1px 5px 0px;
        background-color: #0093ad;
  }
</style>

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
        </div>
    </div>

    <div class="container-fluid">
    <!-- Container fluid  -->
    <!-- order table -->
    <div class="row">
        <div class="col-12">
            <div class="card cstm">
                <div class="card-body">
                    <div class="row">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover bg">
                                <div class="p-2 bg text-center">
                                    <h1 class="font-light text-white" style="font-weight: bold">{{ number_format($totalProduk) }}</h1>
                                    <h6 class="text-white">Total Produk</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover bg">
                                <div class="p-2 bg text-center">
                                    <h1 class="font-light text-white" style="font-weight: bold">{{ $stokProdukMenipis }}</h1>
                                    <h6 class="text-white">Stok Produk Kurang dari 3</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover bg">
                                <div class="p-2 bg text-center">
                                    <h1 class="font-light text-white" style="font-weight: bold">{{ number_format($totalJenisProduk) }}</h1>
                                    <h6 class="text-white">Total Jenis Produk</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover bg">
                                <div class="p-2 bg text-center">
                                    <h1 class="font-light text-white" style="font-weight: bold">{{ $produkKosong }}</h1>
                                    <h6 class="text-white">Produk Kosong</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                    <hr>
                    <div class="div mt-2">
                        <a href="{{ route('PDF.produk') }}" class="btn btn-danger" target="_blank">
                            <i class="far fa-file-pdf"></i> Cetak PDF
                        </a>
                        <button class="btn btn-primary m-1" id="cetakStok">
                            <i class="fas fa-file-pdf"></i> Cetak Stok PDF
                        </button>
                        <button type="button" class="btn btn-success btn-add">
                            <i class="fas fa-plus"></i> Tambah Produk
                        </button>
                        <button type="button" class="btn btn-warning m-1 text-white" id="btn-import">
                            <i class="fas fa-download text-white"></i> Import File
                        </button>
                        <button type="button" class="btn btn-danger" id="resetDataProduk">
                            <i class="fas fa-recycle"></i> Reset Data Produk
                        </button>
                    </div>
                    <div class="tbl" id="reloadTable">
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
{{-- </div> --}}

{{-- Modal Cektak Stok --}}
<div id="modalCetekStok" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" id="formActionStok" action="{{ route('PDF.stokProduk') }}" method="post" target="_blank">
                @csrf
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel"style="color: black"><strong>Cetak Stok Produk</strong></h3>
            </div>
            <div class="modal-body">
                <h6><font color="red">Cetak produk dengan stok kurang dari:</font></h6>
                    <div class="form-group">
                        <input type="text" class="form-control stok" name="stok" value="" required style="font-size:25pt;font-weight: bold;" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

{{-- Modal Import data Produk --}}
<div id="importDataProduk" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" id="formAction" action="" method="post">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel"style="color: black">
                    <strong>
                        Import File Produk
                    </strong>
                </h3>
            </div>
            <div class="modal-body">
                <h6>Database Produk (CSV/XLs)</h6>
                    {{-- <input type="hidden" value="" name="id_jenis_produk"> --}}
                    <div class="form-group">
                        <input type="file" class="form-control" placeholder="Ketik disini" name="kategori_produk" value="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script>
    
    // Script Show Modal Add data
   $('#btn-import').on('click', function(){
        $('#importDataProduk').modal('show');
        // $.ajax({
        //     method : 'get',
        //     url : `{{ url('modal-show-pelanggan') }}`,
        //     headers : {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //     success : function(res){
        //         $('#modalAction').find('.modal-dialog').html(res)
        //         console.log(res)
        //         $('#modalAction').modal('show');
        //         store()
        //     }
        // })
    })

    $('#resetDataProduk').on('click',function(){
        // alert('test');
        resetProduk();
    })

    function tambahData() {
            $('.jenisProduk').select2();
    };

    function ubahData() {
            $('.ubah_alamat').select2();
    };
    

    // function reset transaksi
    function resetProduk(){
                Swal.fire({
                title: "Anda Yakin ?",
                text: "Data produk akan di kosongkan !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal",
                confirmButtonText: "Yakin"
            }).then(result => {
            if (result.value) {
                $.ajax({
                    method  : 'DELETE',
                    url     : 'reset-data-produk',
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(res){
                        Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                        })
                        window.LaravelDataTables["produk-table"].ajax.reload()
                    }
                })
            }
        });
    }   

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
                        Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
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

                let hargaBeliProduk = ($('#harga-beli').val() == "") ? 0 : $('#harga-beli').val();
                let hargaJualProduk = ($('#harga-jual').val() == "") ? 0 : $('#harga-jual').val();
                if(parseFloat(hargaJualProduk) <= parseFloat(hargaBeliProduk)){
                    Toast.fire({
                                icon    : 'error',
                                title   : 'Gagal, Harga jual produk lebih kecil dari harga beli.',
                            })
                }
                else{
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
                            if(res.status == "Gagal"){
                                Toast.fire({
                                    icon    : res.icon,
                                    title   : res.status + ', ' + res.message,
                                })
                            }
                            else{
                                Toast.fire({
                                    icon    : res.icon,
                                    title   : res.status + ', ' + res.message,
                                })
                                window.LaravelDataTables["produk-table"].ajax.reload()
                                $('#modalAction').modal('hide');
                            }
                        }
                    })
                }
            })
        }

        $('#cetakStok').on('click', function(){
            $('#modalCetekStok').modal('show');
                $('#formActionStok').on('submit', function(e){
                    $('#modalCetekStok').modal('hide')
                })
                $('.stok').val("");
        });


</script>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
@extends('layouts.main')
@section('container')
@include('layouts.swetalert')
{{-- {{ $dataTable->table() }} --}}
<link href="{{ url('style/dist/css/custome.css')}}" rel="stylesheet"/>
<style>
    /* table{
        padding: 0.2px;
    } */
    .table{
        width: 98.5%;
    }
    
</style>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                {{-- <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ $headPage }}</h3> --}}
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('jenisProduk') }}">Admin / {{ $headPage }}</a>
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
                        
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <!-- Container fluid  -->
            <div class="card cstm">
                <div class="card-header">
                    <h5 class="card-title"><font color="white">{{ $headPage }}</font></h5>
                </div>
                <div class="card-body" id="page-detail">
                    <div class="row">
                        <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Cetak Berdasarkan Produk</label> 
                                    <div class="div" id="reloadSelect">
                                        <select class="form-control valueProduk"  style="width: 100%" name="id_produk" id="valueProduk">   
                                            <option value='0'> <font> -- Pilih Produk -- </font></option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                       
                        <div class="col-4">
                            <label for="exampleFormControlSelect1">Cetak Berdasarkan Kategori</label> 
                            <div class="div" id="reloadSelect">
                                <select class="form-control valueKategori"  style="width: 100%" id="kategoriProduk" name="id_produk">   
                                    <option value='0'> <font> -- Pilih Kategori Produk -- </font></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="exampleFormControlSelect1">Cetak Lable Semua Produk</label><br>
                            <a href="{{ route('PDF.lableHarga') }}" type="button" class="btn btn-danger" id="btn-cetak-lable-harga" target="_blank">
                                <i class="fas fa-print"></i> Cetak Semua
                            </a>
                        </div>
                    </div>
                    <hr>
                {{-- <div class="detailProduk mt-4">  --}}
                    <div class="div mt-4">
                        <button type="button" class="btn btn-success btn-cetak mr-1">
                            <i class="fas fa-print"></i> Cetak Lable Produk Terpilih
                        </button>
                        <button type="button" class="btn btn-danger" id="resetProdukTerpilih">
                            <i class="fas fa-recycle"></i> Reset Produk Terpilih
                        </button>
                    </div>
                    <div class="mt-2" id="reloadTable">
                        <div class="table-responsive mt-2">
                            {{-- <h5>Produk Terpilih</h5> --}}
                            {!! $dataTable->table(['class' => 'table table-striped table-bordered no-wrap dataTable','style'=>'width:100%']) !!}
                        </div>
                    </div>
                {{-- </div>  --}}
            </div>
        </div>
    </div>
    </div>
  

{{-- Modal Ubah Data --}}
<div id="modalAction" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        {{-- Ambil dari blade action --}}
    </div>
</div>
{{-- Modal Ubah Data End--}}

<script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        getDataProduk();
        getDataKategoriProduk();

        // $('.detailProduk').hide();
        $('#alert').hide();


        // onclick button reset transaksi
        $('#resetProdukTerpilih').on('click',function(){
            resetDataTerpilih();
        })
        
        // onclick button cetak data terpilih
        $('.btn-cetak').on('click',function(){
            cetakProdukTerpilih();
        })

    

    // proses simpan data ke cart dengan select2
    $(".valueProduk").change(function(){
                event.preventDefault()
                $.ajax({
                    method  : 'post',
                    url     : 'add-temp-produk-lable',
                    data    : {
                           barcode : $('#valueProduk').val(),
                    },
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success : function(res){
                        Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                            })
                        window.LaravelDataTables["templableharga-table"].ajax.reload()
                    }
                })
        });


    // proses cetak lable harga produk by kategori
    $("#kategoriProduk").change(function(){
                event.preventDefault()
                $.ajax({
                    method  : 'post',
                    url     : "{{ route('add.ProdukToTempByKategori') }}",
                    data    : {
                           fkid_jenis_produk : $('.valueKategori').val(),
                    },
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success : function(res){
                        Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                            })
                        window.LaravelDataTables["templableharga-table"].ajax.reload()
                    }
                })
        });

    $('#templableharga-table').on('click','.action',function(){
        let data    = $(this).data()
        let id      = data.id
        // let jenis   = data.jenis
        event.preventDefault()
        $.ajax({
                method  : 'DELETE',
                url     : `{{ url('hapus-temp-lable-harga') }}/${id}`,
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function(res){
                    Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                            })
                    window.LaravelDataTables["templableharga-table"].ajax.reload()
                }
            })
    })

    })

    // function memanggil data produk untuk ditampilkan dalam select2
    function getDataProduk(){
            $('.valueProduk').select2({
                ajax: { 
                url: "{{ route('getProduk') }}",
                type: "post",
                dataType: 'json',
                delay: 100,
                data: function (params) {
                return {
               _token: CSRF_TOKEN,
               search: params.term // search term
            };
          },
            processResults: function (response) {
            return {
              results : response
                };
            },
            cache: true
            }
        });
    }

    
    // function memanggil data kategori untuk ditampilkan dalam select2
    function getDataKategoriProduk(){
            $('#kategoriProduk').select2({
                ajax: { 
                url: "{{ route('getKategoriProduk') }}",
                type: "post",
                dataType: 'json',
                delay: 100,
                data: function (params) {
                return {
               _token: CSRF_TOKEN,
               search: params.term // search term
            };
          },
            processResults: function (response) {
            return {
              results : response
                };
            },
            cache: true
            }
        });
    }


    //Function Button Reset Produk Terpilih
    function resetDataTerpilih(){
                Swal.fire({
                title: "Anda Yakin ?",
                text: "Produk terpilih, Akan di kosongkan !",
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
                    url     : 'reset-produk-terpilih',
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(res){
                        Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                            })
                        window.LaravelDataTables["templableharga-table"].ajax.reload()
                    }
                })
            }
        });
    }
    
    // function cetak lable produk terpilih
    function cetakProdukTerpilih(){
        $.ajax({
            method : 'get',
            url : `{{ url('cetak-lable-produk-terpilih') }}`,
            data : {
                    },
            headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            success : function(res){
                    if(res.status == 'Gagal'){
                        Swal.fire({
                            icon    :  res.icon,
                            title   :  res.status,
                            text    :  res.message,
                        })                   
                    }
                    else{
                        newTab();
                    }
                }
        })
    }


    function newTab(){
        var url = "{{ route('PDF.lableHargaByProduk') }}";
            window.open(url, "_blank");
    }
    function newTabKategori(){
        var url = "{{ route('PDF.getlableHargaByKategori') }}";
            window.open(url, "_blank");
    }
</script>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
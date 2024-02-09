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
                    <h5 class="card-title"><font color="white">Cek Harga Produk</font></h5>
                </div>
                <div class="card-body" id="page-detail">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Scan Kode Produk</label>
                                <input class="form-control kodeBarcode" type="text" name="" placeholder="Masukan atau scan barcode produk" id="kodeBarcode" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                                <label for="exampleFormControlSelect1">Cari Berdasarkan Nama Produk</label> 
                                <div class="div" id="reloadSelect">
                                    <select class="form-control produk"  style="width: 100%" id="produk" name="id_produk">   
                                        <option value='0'> <font> -- Pilih Produk -- </font></option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <hr>
                <div class="detailProduk mt-4"> 
                    <div class="row mt-6">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Barcode Produk</label>
                                        <input type="text" class="form-control" id="barcodeProduk" aria-describedby="name" placeholder="Ketik disini" name="nama_produk" value="" required readonly>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Nama Produk</label>
                                        <input type="text" class="form-control" id="namaProduk" aria-describedby="name" placeholder="Ketik disini" name="nama_produk" value="" required readonly>
                                    </div>
                                </div>
                                <div class="col-4 mt-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Stok Produk</label>
                                        <input type="text" class="form-control" id="stokProduk" aria-describedby="name" placeholder="Ketik disini" name="stok_produk" value="" required readonly>
                                    </div>
                                </div>
                                <div class="col-4 mt-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Tempat Produk</label>
                                        <input type="text" class="form-control" id="tempatProduk" aria-describedby="name" placeholder="Masukan margin produk" name="margin" required value="" readonly>
                                    </div>
                                </div>
                                <div class="col-4 mt-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Jenis Produk</label>
                                        <input type="text" class="form-control" id="jenisProduk" aria-describedby="name" placeholder="Masukan margin produk" name="margin" required value="" readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-4 mt-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Margin (Keuntungan)</label>
                                        <input type="text" class="form-control" id="margin-produk" aria-describedby="name" placeholder="Masukan margin produk" name="margin" required value="Rp 90.000" readonly>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Harga Produk</label>
                                        <input style="font-size: 50px; font-weight: bold; color:rgb(0, 165, 22);" type="text" class="form-control" id="hargaJual" aria-describedby="name" placeholder="Ketik disini" name="stok_produk" value="" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert" id="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Gagal Menemukan Produk</strong>, Produk tidak terdaftar dalam database..!
                </div>
                </div>
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

        $('.detailProduk').hide();
        $('#alert').hide();

        // event enter di scan barcode
        $('#kodeBarcode').keydown(function(e){
                if(e.keyCode==13){
                    cekKode();
                    e.preventDefault();
                    // $("#kodeBarcode").val("");
                }
        })

        // proses ambil detail harga produk dengan select2
        $(".produk").change(function(){
            event.preventDefault()
                $.ajax({
                    method  : 'post',
                    url     : 'get-detail-harga-produk',
                    data    : {
                        barcode : $('#produk').val(),
                        },
                        headers : {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success : function(res){
                                $('#alert').hide();
                                $('.detailProduk').show();
                                $('#barcodeProduk').val(res.barcodeProduk)
                                $('#namaProduk').val(res.namaProduk)
                                $('#stokProduk').val(res.stokProduk)
                                $('#hargaBeli').val(res.hargaBeli)
                                $('#tempatProduk').val(res.tempatProduk)
                                $('#jenisProduk').val(res.jenisProduk)
                                $('#hargaJual').val("Rp"+" "+ res.hargaProduk)
                        }
                })
            });

    })
    

    // function memanggil data untuk ditampilkan dalam select2
    function getDataProduk(){
            $('.produk').select2({
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

    // function untuk mengirim data ke controller sebagai input cek kode produk
    function cekKode(){
            let kode = $('#kodeBarcode').val();
            event.preventDefault()
                $.ajax({
                    method  : 'post',
                    url     : 'get-detail-harga-produk',
                    data    : {
                        barcode : kode,
                    },
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success : function(res){
                        if(res.icon == 'Gagal'){
                            $('.detailProduk').hide();
                            $('#alert').show();
                        }
                        else{
                            $('#kodeBarcode').val("");
                            $('#alert').hide();
                            $('.detailProduk').show();
                            $('#barcodeProduk').val(res.barcodeProduk)
                            $('#namaProduk').val(res.namaProduk)
                            $('#stokProduk').val(res.stokProduk)
                            $('#hargaBeli').val(res.hargaBeli)
                            $('#tempatProduk').val(res.tempatProduk)
                            $('#jenisProduk').val(res.jenisProduk)
                            $('#hargaJual').val("Rp"+" "+ res.hargaProduk)
                        }
                    }
                })
    }
</script>
@endsection

{{-- @push('scripts')
    {{$dataTable->scripts()}}
@endpush --}}
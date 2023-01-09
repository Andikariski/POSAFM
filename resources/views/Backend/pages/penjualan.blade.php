@extends('layouts.main')
@section('container')
@include('layouts.swetalert')

<link href="{{ url('style/dist/css/custome.css')}}" rel="stylesheet"/>
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
                {{-- <h3 class="page-title text-truncate text-dark font-weight-medium">Halaman {{ $headPage }}</h3> --}}
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="">Admin / {{ $headPage }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                </div>
            </div>
        </div>
    </div>
        <div class="container-fluid" id="body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xlg-4">
                            <div class="card cstm" style="height: 12rem;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="inputPassword6" class="col-form-label">Tanggal</label>
                                        </div>
                                        <div class="col-8">
                                            {{-- <input type="date" class="form-control" value="{{ Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->isoFormat('D MMMM YYYY') }}" readonly> --}}
                                            <label for="inputPassword6" class="col-form-label"><strong>{{ Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->isoFormat('D MMMM YYYY') }}</strong></label>
                                            <input type="hidden" id="tanggal" class="form-control" readonly value="{{ date('Y-m-d') }}" name="tanggal">
                                        </div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-4">
                                            <label for="inputPassword6" class="col-form-label">Kasir</label>
                                        </div>
                                        <div class="col-8">
                                            <label for="inputPassword6" class="col-form-label"><strong>{{ Auth::user()->name }}</strong></label>
                                            <input type="hidden" id="user" class="form-control" aria-describedby="passwordHelpInline" readonly value="{{ Auth::user()->id }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="inputPassword6" class="col-form-label">Pelanggan</label>
                                        </div>
                                        <div class="col-8 mt-2">
                                            <select class="form-control produk"  style="width: 100%" id="pelanggan" name="fkid_pelanggan">   
                                                <option value="1" selected>Umum</option>
                                                @foreach ($pelanggan as $pl)
                                                <option value="{{ $pl->id_pelanggan }}">{{ $pl->nama_pelanggan }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-4 col-xlg-4">
                            <div class="card cstm" style="height: 12rem;">
                                <div class="card-body" id="reloadPorduk">
                                    <div class="form-group">
                                     {{-- <label for="exampleFormControlSelect1">Cari Produk</label> --}}
                                        <div class="div" id="reloadSelect">
                                            <select class="form-control produk"  style="width: 100%" id="produk" name="id_produk">   
                                                <option value='0'> <font> -- Pilih Produk -- </font></option>
                                                {{-- @foreach ($DataProduk as $produk)
                                                    <option value="{{ $produk->barcode_produk }}">{{ $produk->nama_produk }}</option>
                                                    @endforeach --}}
                                                </select>
                                        </div>
                                        
                                        <div class="row">
                                            {{-- <div class="col-4">
                                                <label for="inputPassword6" class="col-form-label">Cari Produk</label>
                                            </div> --}}
                                            {{-- <div class="col-12">
                                               <button type="button" class="btn btn-outline-info btn-block daftarproduk"> Cari Dari Daftar Produk </button>
                                            </div> --}}
                                        </div>
                                        <div class="form-group mt-4">
                                            <label for="exampleFormControlSelect1">Scan Kode Produk</label>
                                            <input class="form-control" type="text" name="" placeholder="Masukan atau scan barcode produk" id="kodeBarcode" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{-- <div class="col-6">
                                            <label for="inputPassword6" class="col-form-label">Jumlah Produk</label>
                                        </div> --}}
                                        <div class="col-6">
                                            <input type="hidden" id="jumlah_produk" class="form-control" name="jumlah_produk" value="1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xlg-4">
                            <div class="card cstm" style="height: 12rem;">
                                <div class="card-body">
                                    <div class="text-left">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="inputPassword6" class="col-form-label">No Faktur</label>
                                            </div>
                                            <div class="col-8">
                                                <div id="reloadFaktur" class="div">
                                                    <input type="text" id="faktur" class="form-control" readonly value="{{ $faktur }}" name="faktur" style="color:red; font-weight: bold;">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        {{-- <div class="row"> --}}
                                        <div class="div mb-2"  id="reloadTotalBayar">
                                                <h5 class="" style="color: red">Total Harga Produk*</h5>
                                                <h1 class="mt-2"><strong style="font-weight: bold; color:rgb(0, 165, 22); font-size:30pt;">Rp {{ number_format($totalBelanja) }}</strong></h1>
                                                <input type="hidden" value="{{ $totalBelanja}}" id="totalbelanja">
                                        </div>
                                        {{-- </div> --}}
                                        {{-- <input type="hidden" name="" id="faktur" value="0111"> --}}
                                        {{-- <h5 class="text-black mb-4">Invoice <strong style="color: black">AR13263126</strong></h5> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card cstm">
                        <div class="card-body">
                            <div class="row">
                                <div class="div col">
                                    <div class="div" id="reloadTotalProduk">
                                        <a class="notification">
                                            <i class="fas fa-shopping-cart fa-2x mt-2" style="color: #0093ad"></i>
                                                @if (!$totalProdukTerpilih == 0)
                                                <span class="badge"><strong class="font" id="font">{{ $totalProdukTerpilih }}</strong></span>
                                                @endif
                                          </a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="text-align:right">
                                        <button class="btn btn-danger m-2" id="resetTransaksi">
                                            <i class="fas fa-recycle"></i> 
                                             Reset Transaksi
                                        </button>
                                        <button class="btn btn-success" id="pembayaran">
                                            <i class="fas fa-cart-plus"></i> 
                                             Pembayaran
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4" id="reloadTable">
                                <div class="table-responsive mt-6" >
                                    {!! $dataTable->table(['class' => 'table table-striped table-bordered no-wrap dataTable']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- Modal Pembayaran --}}
<div id="modalAction" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        {{-- Ambil dari blade action --}}
    </div>
</div>
{{-- Modal Ubah Data End--}}
  
    
<script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        // get data produk with select2
        getDataProduk();

        // set autofocus in modal pembayaran
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
        $('#kodeBarcode').focus();


        $('#pelanggan').select2({
            maximumSelectionLength: 3
        });
        
        // event enter di scan barcode
        $('#kodeBarcode').keydown(function(e){
                if(e.keyCode==13){
                    e.preventDefault();
                    cekKode();
                    $("#kodeBarcode").val("");
                }
        })

        // onclick button pembayaran
        $('#pembayaran').on('click', function(){
            showModalPembayaran();
        })
        
        // onclick button reset transaksi
        $('#resetTransaksi').on('click',function(){
            resetTransaksi();
        })

        // Button With keycode
        $(document).keydown(function(e){
            switch(e.which){
                case 16:
                    showModalPembayaran();
                    break;
                case 8:
                    resetTransaksi();
                    break;
            }
        })
    

    // proses simpan data ke chart dengan select2
    $("#produk").change(function(){
                event.preventDefault()
                // console.log($('#produk').val());
                // alert($('#produk').val());
                $.ajax({
                    method  : 'post',
                    url     : 'add-tempTransaksi',
                    data    : {
                        fkid_barcode_produk : $('#produk').val(),
                        faktur              : $('#faktur').val(),
                        // fkid_pelanggan      : $('#pelanggan').val(),
                        // fkid_user           : $('#kasir').val(),
                        jumlah_produk       : $('#jumlah_produk').val(),
                        tanggal             : $('#tanggal').val(),
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
                        window.LaravelDataTables["temptransaksi-table"].ajax.reload()
                        $('#reloadTotalBayar').load(window.location.href + " #reloadTotalBayar")
                        $('#reloadTotalProduk').load(window.location.href + " #reloadTotalProduk")
                    // }
                    }
                })
    });
    

    // hapus item di tabel chart
    $('#temptransaksi-table').on('click','.action',function(){
    // $('.btn-hapus').click(function(){
        let data    = $(this).data()
        let id      = data.id
        let jenis   = data.jenis
        event.preventDefault()
        if(jenis == 'delete'){
            let data    = $(this).data()
            let id      = data.id
            $.ajax({
                method  : 'DELETE',
                url     : `{{ url('hapus-item-transaksi') }}/${id}`,
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function(res){
                    window.LaravelDataTables["temptransaksi-table"].ajax.reload()
                    $('#reloadTotalBayar').load(window.location.href + " #reloadTotalBayar")
                    $('#reloadTotalProduk').load(window.location.href + " #reloadTotalProduk")
                }
            })
        }
        else if(jenis == 'tambahJumlah'){
            // alert('Tambah  jumlah data')
            let data    = $(this).data()
            let id      = data.id
            $.ajax({
                method : 'get',
                url : `{{ url('modal-tambah-jumlah') }}/${id}`,
                success : function(res){
                    $('#modalAction').find('.modal-dialog').html(res)
                    $('#modalAction').modal('show');
                    tambahJumlahProduk();
                }
            })
        }
    })
});

// function tambah jumlah produk dalam chart
function tambahJumlahProduk(){
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
                        if(res.status == "Berhasil"){
                            Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                            })
                            $('#modalAction').modal('hide');
                            window.LaravelDataTables["temptransaksi-table"].ajax.reload()
                            $('#reloadTotalBayar').load(window.location.href + " #reloadTotalBayar")
                            $('#reloadTotalProduk').load(window.location.href + " #reloadTotalProduk")
                            $('#reloadFaktur').load(window.location.href + " #reloadFaktur")
                        }
                        else{
                            Toast.fire({
                                icon    : res.icon,
                                title   :  res.message,
                            })
                        }
                    }
                })
            })
        }

// function reset transaksi
function resetTransaksi(){
                Swal.fire({
                title: "Anda Yakin ?",
                text: "Data transaksi akan di reset !",
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
                    url     : 'reset-transaksi',
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(res){
                        window.LaravelDataTables["temptransaksi-table"].ajax.reload()
                        $('#reloadTotalBayar').load(window.location.href + " #reloadTotalBayar")
                        $('#reloadTotalProduk').load(window.location.href + " #reloadTotalProduk")
                    }
                })
            }
        });
    }   

// function simpan produk dengan scan barcode   
function cekKode(){
            let kode = $('#kodeBarcode').val();
            event.preventDefault()
                // console.log($('#produk').val());
                // alert($('#produk').val());
                $.ajax({
                    method  : 'post',
                    url     : 'add-tempTransaksi',
                    data    : {
                        fkid_barcode_produk : kode,
                        faktur              : $('#faktur').val(),
                        // fkid_pelanggan      : $('#pelanggan').val(),
                        // fkid_user           : $('#kasir').val(),
                        jumlah_produk       : $('#jumlah_produk').val(),
                        tanggal             : $('#tanggal').val(),
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
                        window.LaravelDataTables["temptransaksi-table"].ajax.reload()
                        $('#reloadTotalBayar').load(window.location.href + " #reloadTotalBayar")
                        $('#reloadTotalProduk').load(window.location.href + " #reloadTotalProduk")
                    }
                })
    }

// function modal pembayaran transaksi
function showModalPembayaran(){
        // $('#modalAction').modal('show');
        $.ajax({
            method : 'get',
            url : `{{ url('modal-show-pembayaran') }}`,
            data : {
                    faktur         : $('#faktur').val(),
                    totalBayar     : $('#totalbelanja').val(),
                    fkid_pelanggan : $('#pelanggan').val(),
                    user           : $('#user').val(),
                    tanggal        : $('#tanggal').val(),
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
                        $('#modalAction').find('.modal-dialog').html(res)
                        $('#modalAction').modal('show');
                        store();
                    }
                }
            })
        }

// Script Store Data untuk menyimpan data kedalam database selama data aman
function store(){
            $('#formAction').on('submit', function(e){
                e.preventDefault()
                const _form = this
                const formData = new FormData(_form)
                const url = this.getAttribute('action')
                
                let jumlahUang = ($('#uangBayar').val() == "") ? 0 : $('#uangBayar').val();
                // let sisaUang = ($('#sisaUang').val() == "") ? 0 : $('#sisaUang').val();
                
                if(parseFloat(jumlahUang) ==""){
                    // alert('kosong')
                    Toast.fire({
                        icon: 'warning',
                        title: 'Jumlah uang belum di inputkan..!'
                    })
                }
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
                        Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                            })
                        $('#modalAction').modal('hide');
                        window.LaravelDataTables["temptransaksi-table"].ajax.reload()
                        $('#reloadTotalBayar').load(window.location.href + " #reloadTotalBayar")
                        $('#reloadTotalProduk').load(window.location.href + " #reloadTotalProduk")
                        $('#reloadFaktur').load(window.location.href + " #reloadFaktur")
                    }
                })
            // }
        })
    }

// function degt data produk 
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

    </script>
@endsection
    
@push('scripts')
{{$dataTable->scripts()}}
@endpush
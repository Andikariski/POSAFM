@extends('layouts.main')
@section('container')
@include('layouts.swetalert')
<link href="{{ url('style/dist/css/custome.css')}}" rel="stylesheet"/>

<style>
    table{
        padding: 0.2px;
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
                            <li class="breadcrumb-item"><a href="{{ route('riwayatTransaksiPenjualan') }}">Admin / {{ $headPage }}</a>
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
    <div class="modal-dialog">
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
      //CRUD function
      $('#hutang-table').on('click','.action',function(){
        let data    = $(this).data()
        let id      = data.id
        let jenis   = data.jenis
        if(jenis == 'bayar'){
        
        $.ajax({
            method : 'get',
            url : `{{ url('modal-show-pembayaran-hutang') }}/${id}`,
            headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            success : function(res){ 
                        $('#modalAction').find('.modal-dialog').html(res)
                        $('#modalAction').modal('show');
                        // store();
                }
            })
            return
        }
    })

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

</script>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
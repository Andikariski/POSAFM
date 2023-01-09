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
//     function tambahData() {
//             $('.jenisProduk').select2();
//             // $('.alamat_edit').select2();
//     };

//     function ubahData() {
//             $('.ubah_alamat').select2();
//             // $('.alamat_edit').select2();
//     };

//       // Script Show Modal Add data
//    $('.btn-add').on('click', function(){
//     // console.log('Test')
//         $('#modalAction').modal('show');
//         $.ajax({
//             method : 'get',
//             url : `{{ url('modal-show-produk') }}`,
//             headers : {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     },
//             success : function(res){
//                 $('#modalAction').find('.modal-dialog').html(res)
//                 console.log(res)
//                 $('#modalAction').modal('show');
//                 store()
//             }
//         })
//     })

      //CRUD function
      $('#riwayattransaksipenjualan-table').on('click','.action',function(){
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
                    url     : `{{ url('hapus-riwayat-transaksi') }}/${id}`,
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(res){
                        Toast.fire({
                                icon    : res.icon,
                                title   : res.status + ', ' + res.message,
                            })
                        window.LaravelDataTables["riwayattransaksipenjualan-table"].ajax.reload()
                    }
                })
            }
        });
            return
        }
    })


//       // Script Store Data untuk menyimpan data kedalam database selama data aman
//       function store(){
//             $('#formAction').on('submit', function(e){
//                 e.preventDefault()
//                 const _form = this
//                 const formData = new FormData(_form)
//                 const url = this.getAttribute('action')
            
//                 $.ajax({
//                     method  : 'post',
//                     url     : url,
//                     headers : {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     },
//                     data    : formData,
//                     processData : false,
//                     contentType : false,
//                     success : function(res){
//                         Swal.fire({
//                             icon    : res.icon,
//                             title   :  res.status,
//                             text    :  res.message,
//                         })
//                         window.LaravelDataTables["produk-table"].ajax.reload()
//                         $('#modalAction').modal('hide');
//                     }
//                 })
//             })
//         } --}}

</script>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
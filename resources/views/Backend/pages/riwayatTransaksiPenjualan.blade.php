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
        </div>
    </div>

    <div class="container-fluid">
    <!-- Container fluid  -->
    <!-- order table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                            {!! $dataTable->table(['class' => 'table table-striped table-bordered no-wrap dataTable']) !!}
                    </div>
                    {{-- <table id="default_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>Nomor Faktur</th>
                                <th>Pelanggan</th>
                                <th>Kasir</th>
                                <th>Tanggal</th>
                                <th width="200px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($dataTransaksi as $item)    
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->faktur }}</td>
                                <td>{{ $item->pelanggan->nama_pelanggan }}</td>
                                <td>{{ $item->kasir->name }}</td>
                                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal)->isoFormat('D MMMM YYYY') }}</td>
                                <td>
                                    {{-- <div class="form-button-action container" style="text-align: center">
                                        <a href="#" class="m-3" data-toggle="modal" data-placement="top"  data-target="#ubahData{{ $item->id_alamat_pelanggan }}">
                                            <i style="color:rgb(41, 228, 94)" class="fas fa-edit fa-1x" data-toggle="tooltip" data-placement="top" title="Ubah alamat"></i>
                                        </a>
                                     
                                        <a class="" href="{{ route('detailRiwayatTransaksi',Crypt::encrypt($item->faktur)) }}">
                                            <i style="color:rgb(249, 37, 37); text-align:center" class="fas fa-eye fa-1x " data-toggle="tooltip" data-placement="top" title="Detail Transaksi"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
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
                        Swal.fire({
                            icon    : res.icon,
                            title   :  res.status,
                            text    :  res.message,
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
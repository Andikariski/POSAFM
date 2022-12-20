@extends('layouts.main')
@section('container')
@include('layouts.swetalert')
{{-- {{ $dataTable->table() }} --}}

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
                        <button type="button" class="btn btn-primary btn-add" id="btn-add">Tambah Jenis Produk</button>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <!-- Container fluid  -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Jenis Produk</h4>
                    <h6 class="card-subtitle">Daftar Jenis produk merupakan pembagian barang berdasarkan kategorinya</h6>
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-striped table-bordered no-wrap dataTable']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  

{{-- <button class="edit ">Edit</button> --}}

{{-- <!-- Modal tambah data -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel" style="color: black"><strong>Tambah Jenis Barang</strong></h4>
        </div>
        <div class="modal-body">
            <h6>Nama Jenis Barang</h6>
            <form class="mt-2" action="{{ route('simpanJenisProduk') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Ketik disini" name="jenis_barang" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div> --}}

{{-- Modal Ubah Data --}}
<div id="modalAction" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        {{-- Ambil dari blade action --}}
    </div>
</div>
{{-- Modal Ubah Data End--}}

<script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script>
    
// Script Show Modal Add data
    $('#btn-add').on('click', function(){
        $('#modalAction').modal('show');
        $.ajax({
            method : 'get',
            url : `{{ url('createJenisProduk') }}`,
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
    })

    // Script Store Data
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
                            icon    : 'success',
                            title   :  res.status,
                            text    :  res.message,
                        })
                        window.LaravelDataTables["jenis_produk"].ajax.reload()
                        $('#modalAction').modal('hide');
                    }
                })
                // console.log(this);
            })
        }

// Script Hapus Data
    $('#jenis_produk').on('click','.action',function(){
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
                    url     : `{{ url('hapusJenisProduk') }}/${id}`,
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(res){
                        Swal.fire({
                            icon    : 'success',
                            title   :  res.status,
                            text    :  res.message,
                        })
                        window.LaravelDataTables["jenis_produk"].ajax.reload()
                    }
            })
            }
        });
            return
        }

        // console.log(id);
        $.ajax({
            method : 'get',
            url : `{{ url('ubahJenisProduk') }}/${id}`,
            success : function(res){
                $('#modalAction').find('.modal-dialog').html(res)
                console.log(res)
                $('#modalAction').modal('show');
                store()
                // console.log(data);
            }
        })

       
    })
</script>

@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
<div class="modal-content">
    <form class="mt-3" id="formAction" action="{{ $pelangganToko->id ? route('updateDataPelangganToko',$pelangganToko->id) : route('simpanDataPelanggan') }}" method="POST">
        <div class="modal-header">
            <h3 class="modal-title" id="myLargeModalLabel" style="color: black">
                <strong>
                    @if ($pelangganToko->id) Ubah
                    @else Tambah
                   @endif Data Pelanggan Toko
               </strong>
            </h3>
        </div>
        <div class="modal-body m-2">
           @csrf
           @if ($pelangganToko->id)
           @method('put')
           @endif
           <div class="row">
               <div class="col-6">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Nama Pelanggan</label>
                       <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Ketik disini" name="nama_pelanggan" value="{{ $pelangganToko->nama_pelanggan }}">
                   </div>
               </div>
               <div class="col-6">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Nomer HP Pelanggan</label>
                       <input type="number" class="form-control" id="nametext" aria-describedby="name" placeholder="Ketik disini" name="nomer_hp" value="{{ $pelangganToko->nomer_hp }}">
                   </div>
               </div>
           </div>

           <div class="row mt-4">
            <div class="col">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Alamat Pelanggan</label>
                    <select class="form-control ubah_alamat"  style="width: 100%" id="exampleFormControlSelect1" name="id_alamat" id="id_alamat">
                        @if (!$pelangganToko->id)
                            <option value="" selected>--Pilih Alamat--</option>
                            @foreach ($alamat as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->alamat_detail }}</option>
                            @endforeach
                        @else
                            <option value="{{$pelangganToko->id_alamat}}" selected>{{ $pelangganToko->alamat->alamat_detail }}</option>
                            @foreach ($alamat as $loc)
                            <option value="{{ $loc->id }}">{{ $loc->alamat_detail }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Deskripsi</label>
                    <textarea class="form-control" id="nametext" aria-describedby="name" placeholder="Ketik disini" name="deskripsi" required>{{$pelangganToko->deskripsi}}</textarea>
                </div>
            </div>
               </div>
           </div>
           <div class="modal-footer mt-2">
            <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close"><i class="fas fa-times"></i> Batal</button>
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
           </div>
       </form>
   </div>


   <script>
     $(document).ready(function() {
            $('.ubah_alamat').select2({
                dropdownParent: $('#modalAction .modal-content')
            });
        });
   </script>
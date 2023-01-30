<div class="modal-content">
    <form class="" id="formAction" action="{{$produk->barcode_produk ?route('updateProduk',$produk->barcode_produk) : route('simpanDataProduk') }}" method="POST">
    <div class="modal-header">
        <h3 class="modal-title" id="myLargeModalLabel" style="color: black">
            <strong>
                @if ($produk->barcode_produk) Ubah
                    @else Tambah
                @endif Produk
            </strong>
        </h3>
    </div>
    <div class="modal-body m-2">
        @csrf
        @if ($produk->barcode_produk)
        @method('put')
        @endif
           <div class="row mt-2">
               <div class="col">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Barcode Produk</label>
                       <input type="number" class="form-control" id="nametext" aria-describedby="name" placeholder="Ketik disini" name="barcode_produk" required value="{{ $produk->barcode_produk }}">
                   </div>
               </div>
           </div>

           <div class="row mt-2">
               <div class="col-6">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Nama Produk</label>
                       <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Ketik disini" name="nama_produk" required value="{{ $produk->nama_produk }}">
                   </div>
               </div>
               <div class="col-6">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Stok Produk</label>
                       <input type="number" class="form-control" id="nametext" aria-describedby="name" placeholder="Ketik disini" name="stok_produk" required value="{{ $produk->stok_produk }}">
                   </div>
               </div>
           </div>

           <div class="row mt-2">               
               <div class="col-6">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Harga Beli Produk</label>
                       <input type="text" class="form-control" style="text-align: right" id="harga-beli" aria-describedby="name" placeholder="Masukan harga beli" name="harga_beli_produk" required value="{{$produk->harga_beli_produk}}">
                   </div>
               </div>
               <div class="col-6">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Margin (Keuntungan)</label>
                       <input type="text" class="form-control" style="text-align: right" id="margin-produk" aria-describedby="name" placeholder="Masukan margin produk" name="margin" required value="{{$produk->margin}}">
                   </div>
               </div>
           </div>

           <div class="row mt-2">               
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tempat Produk</label></label>
                    <select class="form-control"  style="width: 100%" id="tempatProduk" name="fkid_tempat_produk">
                        @if (!$produk->barcode_produk)
                            <option value="" selected> -- Pilih Tempat -- </option>
                            @foreach ($tempatProduk as $tempat)
                            <option value="{{ $tempat->id_tempat_produk }}">{{ $tempat->kode_rak }}</option>
                            @endforeach
                        @else
                            <option value="{{ $produk->fkid_tempat_produk }}" selected>{{ $produk->tempatproduk->kode_rak }}</option>
                            @foreach ($tempatProduk as $tempat)
                            <option value="{{ $tempat->id_tempat_produk }}">{{ $tempat->kode_rak }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
               <div class="col-6">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Kategori Produk</label></label>
                       <select class="form-control jenisProduk"  style="width: 100%" id="exampleFormControlSelect1" name="fkid_jenis_produk">
                        @if (!$produk->barcode_produk)
                            <option value="" selected> -- Pilih Kategori -- </option>
                            @foreach ($jenisProduk as $jenis)
                            <option value="{{ $jenis->id_jenis_produk }}">{{ $jenis->kategori_produk }}</option>
                            @endforeach
                        @else
                            <option value="{{ $produk->fkid_jenis_produk }}" selected>{{ $produk->kategori->kategori_produk }}</option>
                            @foreach ($jenisProduk as $jenis)
                            <option value="{{ $jenis->id_jenis_produk }}">{{ $jenis->kategori_produk }}</option>
                            @endforeach
                    @endif
                       </select>
                   </div>
               </div>
           </div>
        </div>
           <div class="modal-footer mt-2">
                <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close"><i class="fas fa-times"></i> Batal</button>
            @if (!$produk->barcode_produk)
                <button type="reset" class="btn btn-primary"><i class="fas fa-recycle"></i> Reset</button>
            @endif
                <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
            </div>
        </form>
   </div>

   <script>
    $(document).ready(function() {
           $('.jenisProduk').select2({
               dropdownParent: $('#modalAction .modal-content')
           });

           $('#harga-beli').autoNumeric('init',{
            aSep    : ',',
            aDec    : '.',
            mDec    : '0'
           });

           $('#margin-produk').autoNumeric('init',{
            aSep    : ',',
            aDec    : '.',
            mDec    : '0'
           });

           $('#test').autoNumeric('init',{
            aSep    : ',',
            aDec    : '.',
            mDec    : '0'
           });
       });

    $(document).ready(function() {
           $('#tempatProduk').select2({
               dropdownParent: $('#modalAction .modal-content')
           });
       });
  </script>
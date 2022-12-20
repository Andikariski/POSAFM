<div class="modal-content">
    <form class="" id="formAction" action="{{$jenisProduk->id_jenis_produk ? route('updateJenisProduk',$jenisProduk->id_jenis_produk) : route('simpanJenisProduk') }}" method="post">
    <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel"style="color: black">
            <strong>
                @if ($jenisProduk->id_jenis_produk) Ubah
                @else Tambah
                @endif Jenis Barang
            </strong>
        </h3>
    </div>
    <div class="modal-body">
        <h6>Nama Jenis Barang</h6>
            @csrf
            @if ($jenisProduk->id_jenis_produk)
            @method('put')
            @endif
            {{-- <input type="hidden" value="" name="id_jenis_produk"> --}}
            <div class="form-group">
                <input type="hidden" class="form-control" placeholder="Ketik disini" name="id_jenis_produk" value="{{ $jenisProduk->id_jenis_produk }}" required>
                <input type="text" class="form-control" placeholder="Ketik disini" name="kategori_produk" value="{{ $jenisProduk->kategori_produk }}" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
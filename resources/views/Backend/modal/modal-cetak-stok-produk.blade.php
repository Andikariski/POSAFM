<div class="modal-content">
    <form class="" id="formActionStok" action="{{ route('PDF.stokProduk') }}" method="post" target="_blank">
        @csrf
    <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel"style="color: black"><strong>Cetak Stok Produk</strong></h3>
    </div>
    <div class="modal-body">
        <h6><font color="red">Cetak produk dengan stok kurang dari:</font></h6>
            <div class="form-group">
                <input type="text" class="form-control" id="stok" name="stok" required style="font-size:25pt;font-weight: bold;" autocomplete="off">
            </div>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-danger"><i class="fas fa-times"></i> Reset</button>
            <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close"><i class="fas fa-times"></i> Batal</button>
            <button type="submit" id="submit" class="btn btn-primary"><i class="far fa-file-pdf"></i> Cetak</button>
        </div>
    </form>
</div>

{{-- <script>
    $(document).ready(function(){
        $('#submit').on('click', function(){
                $('#stok').val('');
            });
        })
</script> --}}
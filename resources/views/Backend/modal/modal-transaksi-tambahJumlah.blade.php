<div class="modal-content">
    <form class="" id="formAction" action="{{ route('tambahJumlahProduk') }}" method="POST">
        <div class="modal-header">
            <h3 class="modal-title" style="color: black"><strong>Update Jumlah Produk</strong></h3>
        </div>
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <input type="hidden" name="id" id="" value="{{ $dataTemp->id_temp_transaksi_penjualan }}">
                <input type="hidden" name="fkid_barcode_produk" id="" value="{{ $dataTemp->fkid_barcode_produk}}">
                <label for="exampleFormControlInput1" class="form-label"><strong style="color:black"><font color="red">{{ $dataTemp->produk->nama_produk }}</font></strong></label>
                <input type="number" class="form-control form-control-lg" id="jumlahProduk" name="jumlah_produk"
                        style="font-weight: bold; font-size:25pt; text-align:right; color:rgb(51, 51, 51)" value="{{ $dataTemp->jumlah_produk }}">
            </div>
        </div>
        <div class="modal-footer mt-2">
            <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close" id="buttonBatal">Batal</button>
            <button type="submit" class="btn btn-success" arial-label="Close">Selesai</button>
        </div>
    </form>
</div>
<script>
$(document).ready(function() {
     $('#uangBayar').autoNumeric('init',{
            aSep    : ',',
            aDec    : '.',
            mDec    : '0'
        });
        
        $('#totalBayar').autoNumeric('init',{
            aSep    : ',',
            aDec    : '.',
            mDec    : '0'
        });
        
        // $('#sisaUang').autoNumeric('init',{
        //        aSep    : ',',
        //        aDec    : '.',
        //        mDec    : '0'
        //    });

    $('#uangBayar').keyup(function(e){
        sisaUang();
        // console.log($('#uangBayar').val());
    })
});

function sisaUang(){
    let totalBayar = $('#totalBayar').autoNumeric('get');
    let jumlahUang = ($('#uangBayar').val() == "") ? 0 : $('#uangBayar').autoNumeric('get');
    sisa = jumlahUang - totalBayar;
    kembalian = new Intl.NumberFormat('en-US').format(sisa)
    $('#sisaUang').val(kembalian);
    
    

}
</script>
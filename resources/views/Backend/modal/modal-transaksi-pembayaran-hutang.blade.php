<div class="modal-content">
    <form class="" id="formAction" action="{{ route('simpanTransaksi') }}" method="POST">
        <div class="modal-header">
            <h3 class="modal-title" style="color: black"><strong>Pembayaran Hutang</strong></h3>
        </div>
        @csrf
        <div class="modal-body">
            {{-- <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"><strong style="color:black">Total Pembayaran</strong></label>
                <input type="hidden" class="form-control form-control-lg" id="totalBayar" value="{{$totalBayar}}" name="total_pembayaran"
                        style="font-weight: bold; font-size:25pt; text-align:right; color:green" readonly>
                        <h1><strong style="color:rgb(9, 171, 0); font-weight: bold;">Rp {{ number_format($totalBayar) }}</strong></h1>
            </div>
            <hr>
            <div class="mb-3 mt-2">
                <label for="exampleFormControlInput1" class="form-label"><strong style="color:black">Uang Terbayar</strong></label>
                <input type="text" class="form-control form-control-lg" id="uangBayar" name="uang_terbayar"
                style="font-weight: bold; font-size:25pt; text-align:right;" autocomplete="off">
                <label for="exampleFormControlInput1" class="form-label"><h6 style="color:red">*Masukan Rp 0, untuk transaksi tanpa uang terbayar</h6></label>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"><strong style="color:black">Sisa Uang (<font color="red">Kembalian</font>)</strong></label>
                <input type="text" class="form-control form-control-lg" id="sisaUang" name="sisa_uang"
                        style="font-weight: bold; font-size:25pt; text-align:right; color:red" readonly value="">
            </div> --}}
        </div>
        <div class="modal-footer mt-2">
            <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close"><i class="fas fa-times"></i> Batal</button>
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
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
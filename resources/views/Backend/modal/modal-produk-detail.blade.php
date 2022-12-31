<div class="modal-content">
    {{-- <form id="formActionEdit" class="mt-3" action="" method="post"> --}}
        <div class="modal-header">
            <h3 class="modal-title" id="myLargeModalLabel" style="color: black"><strong>Detail Produk</strong></h3>
        </div>
        <div class="modal-body m-2">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="50%">Barcode Produk</td>
                            <td width="50%"><strong>{{ $produk->barcode_produk }}</strong></td>
                        </tr>
                        <tr>
                            <td>Nama Produk</td>
                            <td><strong>{{ $produk->nama_produk }}</strong></td>
                        </tr>
                        <tr>
                            <td>Jenis Produk</td>
                            <td><strong>{{ $produk->kategori->kategori_produk }}</strong></td>
                        </tr>
                        <tr>
                            <td>Tempat Produk</td>
                            <td><strong>{{ $produk->tempatproduk->kode_rak }}</strong></td>
                        </tr>
                        <tr>
                            <td>Harga Beli Produk</td>
                            <td><font color="red"><strong>{{ number_format($produk->harga_beli_produk) }}</strong></font></td>
                        </tr>
                        <tr>
                            <td>Harga Jual Produk</td>
                            <td><font color="#2AC200"><strong>{{ number_format($produk->harga_jual_produk) }}</strong></font></td>
                        </tr>
                        <tr>
                            <td>Keuntungan Produk (Margin)</td>
                            <td><font color="#2AC200"><strong>{{ number_format($produk->margin) }}</strong></font></td>
                        </tr>
                        <tr>
                            <td>Stok Produk</td>
                            <td><strong>{{ $produk->stok_produk }} Produk</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer mt-2">
            <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close" id="buttonBatal"><i class="fas fa-times"></i> Tutup</button>
        </div>
</div>

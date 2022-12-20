<div class="modal-content">
    {{-- <form id="formActionEdit" class="mt-3" action="" method="post"> --}}
        <div class="modal-header">
            <h3 class="modal-title" id="myLargeModalLabel" style="color: black"><strong>Detail Pelanggan PLN</strong></h3>
        </div>
        <div class="modal-body m-2 ml-4">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1" style="color: red">Nama Pelanggan</label>
                        <h2><strong> {{ $dataPelangganPLN->nama->nama_pelanggan}}</strong> </h2>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group ml-4">
                        <label for="exampleFormControlSelect1" style="color: red">Nomer Meteran</label>
                        <h2><strong> {{ $dataPelangganPLN->nomer_pelanggan_pln }}</strong> </h2>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col">
                    <div class="form-group mt-4">
                        <label for="exampleFormControlSelect1" style="color: red">Alamat Pelanggan</label>
                        <h2><strong> {{ $dataPelangganPLN->nama->alamat->alamat_detail }}</strong> </h2>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mt-4 ml-4">
                        <label for="exampleFormControlSelect1" style="color: red">Nomer HP Pelanggan</label>
                        <h2><strong> {{ $dataPelangganPLN->nama->nomer_hp  }} </strong></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer mt-2">
            <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close" id="buttonBatal">Tutup</button>
        </div>
</div>

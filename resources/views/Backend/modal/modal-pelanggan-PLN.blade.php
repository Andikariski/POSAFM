<div class="modal-content">
    <form id="formActionEdit" class="mt-3" action="{{ route('simpan-data-ubah',$dataPelangganPLN->id_pelanggan_pln) }}" method="post">
        <div class="modal-header">
            <h3 class="modal-title" id="myLargeModalLabel" style="color: black"><strong>Ubah Data Pelanggan PLN</strong></h3>
        </div>
        <div class="modal-body m-2">
        @csrf
        <div class="form-group" id="reloadSelect">
            @csrf
            @method('put')
            <label for="exampleFormControlSelect1">Nama Pelanggan PLN</label>
            {{-- <input type="text" class="form-control" placeholder="Ketik disini" name="id_pelanggan" value="" required> --}}
            <select class="form-control"  style="width: 100%" id="pelanggan" name="id_pelanggan_toko" disabled="true">
                <option selected value="{{ $dataPelangganPLN->id_pelanggan_toko }}">{{ $dataPelangganPLN->nama->nama_pelanggan }}</option>
                {{-- @foreach ($dataPelanggan as $pelangganToko)
                <option value="{{ $pelangganToko->id }}">{{ $pelangganToko->nama_pelanggan}}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="exampleFormControlSelect1">ID Pelanggan PLN</label>
            <input type="number" class="form-control" placeholder="Ketik disini" name="nomer_pelanggan_pln" value="{{ $dataPelangganPLN->nomer_pelanggan_pln }}" required>
        </div>
        </div>
        <div class="modal-footer mt-2">
            <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close" id="buttonBatal">Batal</button>
            <button class="btn btn-primary" type="submit" id="simpan">Simpan</button>
        </div>
       </form>
   </div>

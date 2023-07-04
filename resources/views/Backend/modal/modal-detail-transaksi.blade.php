<style>
    .modal-body {
        max-height:550px; 
        overflow-y: auto;
    }

</style>
<div class="modal-content">
    <form class="" id="formAction" action="#" method="POST">
        <div class="modal-header">
            <h3 class="modal-title" style="color: black"><strong>Detail Transaksi</strong></h3>
        </div>
        @csrf
        <div class="modal-body">
                <div class="container-fluid mt-2">
                <div class="row">
                    <div class="col-12">
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="inputPassword6" class="col-form-label">Nomor Faktur</label>
                                            </div>
                                            <div class="col-8">
                                                <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ $dataTransaksi->faktur }}</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="inputPassword6" class="col-form-label">Kasir</label>
                                            </div>
                                            <div class="col-8">
                                                <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ $dataTransaksi->kasir->name }}</strong></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="inputPassword6" class="col-form-label">Tanggal</label>
                                            </div>
                                            <div class="col-8">
                                                {{-- <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ $dataTransaksi->tanggal }}</strong></label> --}}
                                                <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ Carbon\Carbon::createFromFormat('Y-m-d', $dataTransaksi->tanggal)->isoFormat('D MMMM YYYY') }}</strong></label>
            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row ml-4">
                                            <div class="col-4">
                                                <label for="inputPassword6" class="col-form-label">Pelanggan</label>
                                            </div>
                                            <div class="col-8">
                                                <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ $dataTransaksi->pelanggan->nama_pelanggan }}</strong></label>
                                            </div>
                                        </div>
                                        <div class="row ml-4">
                                            <div class="col-4">
                                                <label for="inputPassword6" class="col-form-label">Alamat</label>
                                            </div>
                                            <div class="col-8">
                                                <label for="inputPassword6" class="col-form-label">: <strong class="ml-2">{{ $dataTransaksi->pelanggan->alamat->alamat_detail }}</strong></label>
                                            </div>
                                        </div>
                                        <div class="row ml-4">
                                            <div class="col-4">
                                                <label for="inputPassword6" class="col-form-label">Status Transaksi</label>
                                            </div>
                                            <div class="col-8">
                                                <label for="inputPassword6" class="col-form-label">:
                                                        @if($dataTransaksi->total_pembayaran <= $dataTransaksi->uang_terbayar) 
                                                            <span class="badge bg-success font-16 text-white ml-2">Lunas</span>
                                                        @else
                                                            <span class="badge bg-danger font-16 text-white ml-2">Belum Lunas (Rp {{ number_format($dataTransaksi->uang_terbayar - $dataTransaksi->total_pembayaran) }})</span>
                                                        @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-4">
                                <table class="table table-bordered mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="50px">No</th>
                                            <th>Produk</th>
                                            <th>Harga Satuan Produk</th>
                                            <th style="width: 20%">Jumlah Produk (Qty)</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($dataSubTransaksi as $item)    
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ strtoupper($item->nama_produk) }}</td>
                                            <td>{{ number_format($item->harga_satuan) }}</td>
                                            <td>{{ $item->jumlah_produk }}</td>
                                            <td>{{ number_format($item->sub_total) }}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="table-active">
                                            <td colspan="3" rowspan="3" style="text-align:center; heigh"><strong >Rincian Pembayaran</strong></td>
                                            <td>Total Pembayaran</td>
                                            <td><strong style="color:#2AC200">Rp {{ number_format($dataTransaksi->total_pembayaran) }}</strong></td>
                                        </tr>
                                        <tr class="table-active">
                                            <td>Uang Terbayar</td>
                                            <td><strong>Rp {{ number_format($dataTransaksi->uang_terbayar) }}</strong></td>
                                        </tr>
                                        <tr class="table-active">
                                            <td>Kembalian</td>
                                            <td><strong style="color:#ff0000">Rp {{ number_format($dataTransaksi->uang_terbayar - $dataTransaksi->total_pembayaran) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            {{-- </div>
                        </div> --}}
                    </div>
                </div>
                </div>
        </div>
        <div class="modal-footer mt-2">
            <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal" arial-label="Close"><i class="fas fa-times"></i> Batal</button>
            {{-- <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Bayar</button> --}}
            <button class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fas fa-print"></i></span>Print Faktur</button>
        </div>
    </form>
</div>
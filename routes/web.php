<?php

use App\Http\Controllers\Backend\AbsensiKaryawanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route Jenis Produk
Route::get('/data-jenis-produk', [App\Http\Controllers\Backend\JenisProdukController::class, 'index'])->name('jenisProduk');
Route::get('/ubahJenisProduk/{id}', [App\Http\Controllers\Backend\JenisProdukController::class, 'edit'])->name('edit');
Route::post('/simpanJenisProduk', [App\Http\Controllers\Backend\JenisProdukController::class, 'store'])->name('simpanJenisProduk');
Route::get('/createJenisProduk', [App\Http\Controllers\Backend\JenisProdukController::class, 'create'])->name('createJenisProduk');
Route::delete('/hapusJenisProduk/{id}', [App\Http\Controllers\Backend\JenisProdukController::class, 'destroy'])->name('hapusJenisProduk');
Route::put('/updateJenisProduk/{id}', [App\Http\Controllers\Backend\JenisProdukController::class, 'update'])->name('updateJenisProduk');
Route::post('getKategoriProduk', [App\Http\Controllers\Backend\JenisProdukController::class, 'getDataKategoriProduk'])->name('getKategoriProduk');

// Route Pelanggan
Route::get('/data-pelanggan', [App\Http\Controllers\Backend\PelangganController::class, 'index'])->name('dataPelanggan');
Route::post('/storePelanggan', [App\Http\Controllers\Backend\PelangganController::class, 'store'])->name('simpanDataPelanggan');
Route::post('ubahDataPelanggan/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'update'])->name('updateDataPelanggan');
Route::get('/modal-show-pelanggan', [App\Http\Controllers\Backend\PelangganController::class, 'create'])->name('modal-show');
Route::delete('hapus-data-pelanggan/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'hapusDataPelanggan'])->name('hapusDataPelanggan');
Route::get('/ubah-Pelanggan-Toko/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'edit'])->name('edit');
Route::put('/update-Pelanggan-Toko/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'update'])->name('updateDataPelangganToko');
Route::get('/detail-Pelanggan-Toko/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'detailPelangganToko'])->name('detailPelangganToko');

//Route Pelanggan PLN
Route::get('pelanggan-PLN', [App\Http\Controllers\Backend\PelangganController::class, 'showIdPLN'])->name('dataPelangganPLN');
Route::post('store-pelanggan-pln', [App\Http\Controllers\Backend\PelangganController::class, 'storePelangganPLN'])->name('simpanDataPelangganPLN');
Route::get('get-data-pelanggan', [App\Http\Controllers\Backend\PelangganController::class, 'getDataPelanggan']);
Route::delete('hapus-data-pelanggan-pln/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'destroyPelangganPLN'])->name('hapusPelangganPLN');
Route::get('ubah-pelanggan-PLN/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'showModalUbahDataPelangganPLN'])->name('show-modal-pelanggan-pln');
Route::put('simpan-data-ubah-pelanggan-PLN/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'ubahDataPelangganPLN'])->name('simpan-data-ubah');
Route::get('detail-pelanggan-PLN/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'showModalDetailDataPelangganPLN'])->name('show-modal-pelanggan-pln');

//Route Transaksi Penjualan
Route::get('transaksi-penjualan', [App\Http\Controllers\Backend\TransaksiController::class, 'transaksiPenjualan'])->name('transaksiPenjualan');
Route::post('add-tempTransaksi', [App\Http\Controllers\Backend\TransaksiController::class, 'addProdukTempTransaksi'])->name('addProdukTempTransaksi');
Route::delete('reset-transaksi', [\App\Http\Controllers\Backend\TransaksiController::class, 'resetTransaksi']);
Route::delete('hapus-item-transaksi/{id}', [\App\Http\Controllers\Backend\TransaksiController::class, 'hapusItemTransaksi'])->name('hapusItemTransaksi');
Route::post('get-produk', [App\Http\Controllers\Backend\TransaksiController::class, 'getDataProduk'])->name('getProduk');
Route::get('modal-show-pembayaran', [\App\Http\Controllers\Backend\TransaksiController::class, 'showModalPembayarn'])->name('showModalPembayaran');
Route::post('simpan-transaksi', [App\Http\Controllers\Backend\TransaksiController::class, 'simpanTransaksi'])->name('simpanTransaksi');
Route::get('modal-tambah-jumlah/{id}', [\App\Http\Controllers\Backend\TransaksiController::class, 'showModalTambahJumlah'])->name('showModalTambahJumlah');
Route::post('tambah-jumlah-produk', [\App\Http\Controllers\Backend\TransaksiController::class, 'tambahJumlahProduk'])->name('tambahJumlahProduk');

//Route Riwayat Transaksi
Route::get('riwayat-penjualan', [App\Http\Controllers\Backend\RiwayatTransaksiController::class, 'index'])->name('riwayatTransaksiPenjualan');
Route::delete('hapus-riwayat-transaksi/{id}', [\App\Http\Controllers\Backend\RiwayatTransaksiController::class, 'hapusRiwayatTransaksi'])->name('hapusRiwayatTransaksi');
Route::get('detail-riwayat-transaksi/{id}', [App\Http\Controllers\Backend\RiwayatTransaksiController::class, 'detailTransaksi'])->name('detailRiwayatTransaksi');
Route::get('modal-show-detail-transaksi/{id}', [App\Http\Controllers\Backend\RiwayatTransaksiController::class, 'showDetailTransaksi'])->name('detailRiwayatTransaksi.detail');

// Route Produk
Route::get('data-produk', [App\Http\Controllers\Backend\ProdukController::class, 'index'])->name('dataProduk');
Route::get('detail-produk/{id}', [App\Http\Controllers\Backend\ProdukController::class, 'showDetailProduk'])->name('detailProduk');
Route::post('storeProduk', [App\Http\Controllers\Backend\ProdukController::class, 'store'])->name('simpanDataProduk');
Route::get('getDataProduk', [App\Http\Controllers\Backend\ProdukController::class, 'getDataProduk'])->name('getDataProduk');
Route::delete('hapus-data-produk/{id}', [App\Http\Controllers\Backend\ProdukController::class, 'destroy'])->name('hapusDataProduk');
Route::get('modal-show-produk', [App\Http\Controllers\Backend\ProdukController::class, 'showModalProduk'])->name('modal-show-produk');
Route::get('modal-ubah-produk/{id}', [App\Http\Controllers\Backend\ProdukController::class, 'edit'])->name('modal-edit-produk');
Route::put('simpan-data-ubah-produk/{id}', [App\Http\Controllers\Backend\ProdukController::class, 'update'])->name('updateProduk');
Route::get('modal-show-stok-produk', [App\Http\Controllers\Backend\ProdukController::class, 'showModalCetakStokProduk'])->name('modal-show-stok-produk');
Route::delete('reset-data-produk', [App\Http\Controllers\Backend\ProdukController::class, 'resetProduk'])->name('resetDataProduk');
Route::post('import-produk', [App\Http\Controllers\Backend\ProdukController::class, 'importFileProduk'])->name('importProduk');
Route::get('export-produk', [App\Http\Controllers\Backend\ProdukController::class, 'exportFileProduk'])->name('exportProduk');
Route::get('cek-harga-produk', [App\Http\Controllers\Backend\ProdukController::class, 'cekHargaProduk'])->name('cekHargaProduk');
Route::post('get-detail-harga-produk', [App\Http\Controllers\Backend\ProdukController::class, 'getDetailHargaProduk'])->name('getDetailHargaProduk');
Route::get('cetak-lable-harga-produk', [App\Http\Controllers\Backend\ProdukController::class, 'cetakLableHargaProduk'])->name('cetakLableHarga');

// Route Alamat Pelanggan
Route::get('data-alamat-pelanggan', [App\Http\Controllers\Backend\PelangganController::class, 'dataAlamat'])->name('dataAlamat');
Route::post('storeAlamat', [App\Http\Controllers\Backend\PelangganController::class, 'simpanDataAlamat'])->name('storeDataAlamat');
Route::post('ubahAlamat/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'updateDataAlamat'])->name('updateDataAlamat');
Route::delete('hapusAlamat/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'destroyAlamat'])->name('hapusDataAlamat');


// Route Generate PDF
Route::get('pdf-pelanggan', [App\Http\Controllers\Backend\GeneratePDFController::class, 'generatePDFPelanggan'])->name('PDF.pelanggan');
Route::get('pdf-produk', [App\Http\Controllers\Backend\GeneratePDFController::class, 'generatePDFProduk'])->name('PDF.produk');
Route::post('pdf-stok-produk', [App\Http\Controllers\Backend\GeneratePDFController::class, 'generatePDFstokProduk'])->name('PDF.stokProduk');

// Route Fitur Hutang
Route::get('hutang-pelanggan', [App\Http\Controllers\Backend\HutangController::class, 'index'])->name('hutang');
Route::get('modal-show-pembayaran-hutang/{id}', [App\Http\Controllers\Backend\HutangController::class, 'showModalPembayaranHutang'])->name('hutang.bayar');
Route::get('modal-show-detail-hutang/{id}', [App\Http\Controllers\Backend\HutangController::class, 'showDetailHutang'])->name('hutang.detail');
Route::get('rekapitulasi-hutang/{id}', [App\Http\Controllers\Backend\HutangController::class, 'rekapitulasiHutang'])->name('hutang.rekapitulasi');

// Route Laporan
Route::get('grafik-laporan', [App\Http\Controllers\Backend\LaporanController::class, 'index'])->name('laporan');

// Route JSON Output
Route::get('data-transaksi-mingguan', [App\Http\Controllers\Backend\DashboardController::class, 'statusTransaksiMingguanJSON'])->name('json.transaksiMingguan');
Route::get('data-pemasukan-mingguan', [App\Http\Controllers\Backend\DashboardController::class, 'dataPemasukanMingguanJSON'])->name('json.pemasukanMingguan');

Route::get('data-jumlah-transaksi-bulanan', [App\Http\Controllers\Backend\LaporanController::class, 'dataTransaksiJSON'])->name('json.transaksi');
Route::get('data-pemasukan-bulanan', [App\Http\Controllers\Backend\LaporanController::class, 'dataPemasukanJSON'])->name('json.pemasukan');

Route::get('data-jumlah-transaksi-tahunan', [App\Http\Controllers\Backend\LaporanController::class, 'dataTransaksiTahunanJSON'])->name('json.transaksiTahunan');

//Route Manage User
Route::get('data-user', [App\Http\Controllers\Backend\UserController::class, 'index'])->name('user.index');
Route::get('modal-show-user', [App\Http\Controllers\Backend\UserController::class, 'create'])->name('user.create');
Route::get('modal-show-edit-user/{id}', [App\Http\Controllers\Backend\UserController::class, 'edit'])->name('user.edit');
Route::post('simpan-user', [App\Http\Controllers\Backend\UserController::class, 'store'])->name('user.simpan');
Route::post('update-user', [App\Http\Controllers\Backend\UserController::class, 'update'])->name('user.update');
Route::delete('hapus-user/{id}', [App\Http\Controllers\Backend\UserController::class, 'destroy'])->name('user.hapus');

//Route Grafik laporan
Route::get('laporan-transaksi', [App\Http\Controllers\Backend\LaporanController::class, 'laporanTransaksi'])->name('laporan-transaksi');
// Route::get('filter-data/{filter}',[App\Http\Controllers\Backend\LaporanController::class,'getFilteredData']);

Route::get('filter-data-transaksi/{filter}', [App\Http\Controllers\Backend\LaporanController::class, 'GetDataTransaksi']);

Route::get('filter-data-omsetprofit/{filter}', [App\Http\Controllers\Backend\LaporanController::class, 'getDataOmsetDanProfit']);

//Route Lable Harga
Route::post('add-temp-produk-lable', [App\Http\Controllers\Backend\ProdukController::class, 'addProdukToTempProduk'])->name('add.ProdukToTemp');
Route::delete('hapus-temp-lable-harga/{id}', [App\Http\Controllers\Backend\ProdukController::class, 'deleteTemplable'])->name('deleteTempLable');
Route::delete('reset-produk-terpilih', [App\Http\Controllers\Backend\ProdukController::class, 'resetProdukTerpilih'])->name('resetProdukTerpilih');
Route::get('pdf-lable-harga-produk', [App\Http\Controllers\Backend\GeneratePDFController::class, 'generateLableHargaRak'])->name('PDF.lableHarga');
Route::get('cetak-lable-produk-terpilih', [App\Http\Controllers\Backend\GeneratePDFController::class, 'generateLableHargaRakByProduk'])->name('PDF.lableHargaByProduk');
Route::post('cetak-lable-produk-ByKategori', [App\Http\Controllers\Backend\GeneratePDFController::class, 'generateLableByKategori'])->name('PDF.lableHargaByKategori');

Route::get('cetak-lable-kategori', [App\Http\Controllers\Backend\GeneratePDFController::class, 'generateLableByKategori'])->name('PDF.getlableHargaByKategori');
Route::post('add-temp-produk-lable-byKategori', [App\Http\Controllers\Backend\ProdukController::class, 'addProdukToTempProdukByKategori'])->name('add.ProdukToTempByKategori');


Route::get('cetak-invoice', [App\Http\Controllers\Backend\GeneratePDFController::class, 'invoicePenjualan'])->name('PDF.getInvoice');

//Route absensi karyawan
Route::get('absensi-karyawan', [App\Http\Controllers\Backend\AbsensiKaryawanController::class, 'index'])->name('absensi-karyawan');
Route::get('absensi-karyawan/{id}', [App\Http\Controllers\Backend\AbsensiKaryawanController::class, 'show'])->name('detail-absensi-karyawan');
Route::post('absensi-karyawan', [AbsensiKaryawanController::class, 'store'])->name('tambah-absensi-karyawan');
Route::get('data-absensi-updated', [AbsensiKaryawanController::class, 'getDataAbsensiUpdated'])->name('data-absensi-updated');

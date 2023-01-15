<?php

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
// Route::get('getDataKategori', [App\Http\Controllers\Backend\JenisProdukController::class, 'getDataJenisBarang'])->name('getDataKategori');

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
Route::post('store-pelanggan-pln',[App\Http\Controllers\Backend\PelangganController::class, 'storePelangganPLN'])->name('simpanDataPelangganPLN');
Route::get('get-data-pelanggan',[App\Http\Controllers\Backend\PelangganController::class, 'getDataPelanggan']);
Route::delete('hapus-data-pelanggan-pln/{id}',[App\Http\Controllers\Backend\PelangganController::class, 'destroyPelangganPLN'])->name('hapusPelangganPLN');
Route::get('ubah-pelanggan-PLN/{id}',[App\Http\Controllers\Backend\PelangganController::class,'showModalUbahDataPelangganPLN'])->name('show-modal-pelanggan-pln');
Route::put('simpan-data-ubah-pelanggan-PLN/{id}',[App\Http\Controllers\Backend\PelangganController::class,'ubahDataPelangganPLN'])->name('simpan-data-ubah');
Route::get('detail-pelanggan-PLN/{id}',[App\Http\Controllers\Backend\PelangganController::class,'showModalDetailDataPelangganPLN'])->name('show-modal-pelanggan-pln');

//Route Transaksi Penjualan
Route::get('transaksi-penjualan',[App\Http\Controllers\Backend\TransaksiController::class,'transaksiPenjualan'])->name('transaksiPenjualan');
Route::post('add-tempTransaksi',[App\Http\Controllers\Backend\TransaksiController::class,'addProdukTempTransaksi'])->name('addProdukTempTransaksi');
Route::delete('reset-transaksi',[\App\Http\Controllers\Backend\TransaksiController::class,'resetTransaksi']);
Route::delete('hapus-item-transaksi/{id}',[\App\Http\Controllers\Backend\TransaksiController::class,'hapusItemTransaksi'])->name('hapusItemTransaksi');
Route::post('get-produk',[App\Http\Controllers\Backend\TransaksiController::class,'getDataProduk'])->name('getProduk');
Route::get('modal-show-pembayaran',[\App\Http\Controllers\Backend\TransaksiController::class,'showModalPembayarn'])->name('showModalPembayaran');
Route::post('simpan-transaksi',[App\Http\Controllers\Backend\TransaksiController::class, 'simpanTransaksi'])->name('simpanTransaksi');
Route::get('modal-tambah-jumlah/{id}',[\App\Http\Controllers\Backend\TransaksiController::class,'showModalTambahJumlah'])->name('showModalTambahJumlah');
Route::post('tambah-jumlah-produk',[\App\Http\Controllers\Backend\TransaksiController::class,'tambahJumlahProduk'])->name('tambahJumlahProduk');

//Route Riwayat Transaksi
Route::get('riwayat-transaksi',[App\Http\Controllers\Backend\RiwayatTransaksiController::class,'index'])->name('riwayatTransaksiPenjualan');
Route::get('detail-riwayat/{id}',[App\Http\Controllers\Backend\RiwayatTransaksiController::class,'detailTransaksi'])->name('detailRiwayatTransaksi');
Route::delete('hapus-riwayat-transaksi/{id}',[\App\Http\Controllers\Backend\RiwayatTransaksiController::class,'hapusRiwayatTransaksi'])->name('hapusRiwayatTransaksi');

// Route Produk
Route::get('data-produk', [App\Http\Controllers\Backend\ProdukController::class, 'index'])->name('dataProduk');
Route::get('detail-produk/{id}', [App\Http\Controllers\Backend\ProdukController::class, 'showDetailProduk'])->name('detailProduk');
Route::post('storeProduk', [App\Http\Controllers\Backend\ProdukController::class, 'store'])->name('simpanDataProduk');
Route::get('getDataProduk', [App\Http\Controllers\Backend\ProdukController::class, 'getDataProduk'])->name('getDataProduk');
Route::delete('hapus-data-produk/{id}', [App\Http\Controllers\Backend\ProdukController::class, 'destroy'])->name('hapusDataProduk');
Route::get('modal-show-produk',[App\Http\Controllers\Backend\ProdukController::class,'showModalProduk'])->name('modal-show-produk');
Route::get('modal-ubah-produk/{id}',[App\Http\Controllers\Backend\ProdukController::class,'edit'])->name('modal-edit-produk');
Route::put('simpan-data-ubah-produk/{id}',[App\Http\Controllers\Backend\ProdukController::class,'update'])->name('updateProduk');
Route::get('modal-show-stok-produk',[App\Http\Controllers\Backend\ProdukController::class,'showModalCetakStokProduk'])->name('modal-show-stok-produk');

// Route Alamat Pelanggan
Route::get('data-alamat-pelanggan', [App\Http\Controllers\Backend\PelangganController::class, 'dataAlamat'])->name('dataAlamat');
Route::post('storeAlamat', [App\Http\Controllers\Backend\PelangganController::class, 'simpanDataAlamat'])->name('storeDataAlamat');
Route::post('ubahAlamat/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'updateDataAlamat'])->name('updateDataAlamat');
Route::get('hapusAlamat/{id}', [App\Http\Controllers\Backend\PelangganController::class, 'destroyAlamat'])->name('hapusDataAlamat');


// Route Generate PDF
Route::get('pdf-pelanggan',[App\Http\Controllers\Backend\GeneratePDFController::class,'generatePDFPelanggan'])->name('PDF.pelanggan');
Route::get('pdf-produk',[App\Http\Controllers\Backend\GeneratePDFController::class,'generatePDFProduk'])->name('PDF.produk');
Route::post('pdf-stok-produk',[App\Http\Controllers\Backend\GeneratePDFController::class,'generatePDFstokProduk'])->name('PDF.stokProduk');

// Route Fitur Hutang
Route::get('hutang-pelanggan',[App\Http\Controllers\Backend\HutangController::class,'index'])->name('hutang');
Route::get('modal-show-pembayaran-hutang/{id}',[App\Http\Controllers\Backend\HutangController::class,'show'])->name('hutang.bayar');

// Route Laporan
Route::get('laporan',[App\Http\Controllers\Backend\LaporanController::class,'index'])->name('laporan');

// Route JSON Output
Route::get('data-pemasukan-mingguan', [App\Http\Controllers\Backend\DashboardController::class, 'dataPemasukanMingguanJSON'])->name('json.pemasukanMingguan');
Route::get('data-transaksi-mingguan', [App\Http\Controllers\Backend\DashboardController::class, 'statusTransaksiMingguanJSON'])->name('json.transaksiMingguan');

Route::get('data-jumlah-transaksi-bulanan',[App\Http\Controllers\Backend\LaporanController::class,'dataTransaksiJSON'])->name('json.transaksi');
Route::get('data-pemasukan-bulanan',[App\Http\Controllers\Backend\LaporanController::class,'dataPemasukanJSON'])->name('json.pemasukan');
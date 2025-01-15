<?php

use App\Http\Controllers\Api\AbsensiKaryawancontroller;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->post('logout', [RegisterController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('products/{barcode_produk}', [ProductController::class, 'show']);
    Route::get('products', [ProductController::class, 'index']);
    Route::post('absensi-karyawan', [AbsensiKaryawancontroller::class, 'store']);
    Route::get('absensi-karyawan-hari-ini', [AbsensiKaryawancontroller::class, 'index']);
    Route::get('absensi-karyawan-bulanan', [AbsensiKaryawancontroller::class, 'getDataAbsensiBulanan']);
});

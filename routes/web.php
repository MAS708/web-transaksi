<?php

use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PromoController;
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

Route::get('/', function () {
    return view('dashboard');
});
Route::controller(MasterBarangController::class)->group(function () {
    Route::resource('/barang', MasterBarangController::class);
});
Route::controller(PromoController::class)->group(function () {
    Route::resource('/promo', PromoController::class);
});
Route::controller(PenjualanController::class)->group(function () {
    Route::resource('/penjualan', PenjualanController::class);
});

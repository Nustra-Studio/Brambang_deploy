<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\TransactionController;

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
    return view('page.dashboard');
});
Route::get('/inputbarang', function () {
    return view('page.fitur.inputbarang');
});
    Route::get('/laporan-keuangan', function () {
        return view('page.fitur.laporan');
    });
    Route::get('/history/barangmasuk', function () {
        return view('page.history.masuk');
    });
    Route::get('/history/barangkeluar', function () {
        return view('page.history.keluar');
    });
    Route::get('/history/transaction', function () {
        return view('page.history.transaction');
    });
Route::resource('/barang', BarangController::class);
Route::resource('/customer', CustomerController::class);
Route::resource('/karyawan', KaryawanController::class);
Route::resource('/production', ProductionController::class);
Route::resource('/transaction', TransactionController::class);
Route::prefix('dataresource')->group(function () {
    Route::get('/barang', 'App\Http\Controllers\BarangController@data')->name('barang.data');
    Route::get('/barang/jual', 'App\Http\Controllers\BarangController@jual')->name('barang.jual');
    // Route::post('/customer', 'CustomerController@search')->name('customer.data');
    // Route::post('/karyawan', 'KaryawanController@data')->name('karyawan.data');
    // Route::post('/production', 'ProductionController@data')->name('barang.data');
});

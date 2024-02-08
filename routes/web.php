<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BarangController;

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

Route::resource('/barang', BarangController::class);
Route::resource('/customer', CustomerController::class);
Route::resource('/karyawan', KaryawanController::class);
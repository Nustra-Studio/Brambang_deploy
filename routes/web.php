<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\ProductionGroupController;
use App\Http\Controllers\NewProductionController;
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

Route::get('/login',function(){
    return view('page.auth.login');
});
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/', function () {
        return view('page.dashboard');
    });
    Route::get('/laporan-keuangan', function () {
        return view('page.fitur.laporan');
    });
    Route::get('/mutasi', function () {
        return view('page.fitur.keuangan');
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
    Route::get('/history/hutang', function () {
        return view('page.history.hutang');
    });
    Route::get('/catatan/hutanglama', function () {
        return view('page.catatan.hutanglama');
    });
    Route::get('/catatan/piutangpribadi', function () {
        return view('page.catatan.piutanglama');
    });
    Route::get('/laporan/produksi', function () {
        return view('page.fitur.laporanproduction');
    });

    Route::resource('user', UserController::class);
    Route::get('/hutang','App\Http\Controllers\TransactionController@hutang');
    Route::get('/invoicelama','App\Http\Controllers\TransactionController@invoice');
    Route::get('/printproduction','App\Http\Controllers\TransactionController@print');
    Route::get('/hapusinvoice','App\Http\Controllers\TransactionController@invoicehapus');
    Route::get('/bahan-baku','App\Http\Controllers\BarangController@bahanbaku');
    Route::resource('/barang', BarangController::class);
    Route::post('/barang/add','App\Http\Controllers\BarangController@add')->name('barang.add');
    Route::resource('/productiongroup', ProductionGroupController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/karyawan', KaryawanController::class);
    Route::resource('/bank', BankController::class);
    Route::resource('/production', ProductionController::class);
    Route::resource('/transaction', TransactionController::class);
    Route::resource('/catatan', CatatanController::class);
    Route::resource('/newproduction', NewProductionController::class);
Route::prefix('dataresource')->group(function () {
    Route::get('/barang', 'App\Http\Controllers\BarangController@data')->name('barang.data');
    Route::get('/barang/jual', 'App\Http\Controllers\BarangController@jual')->name('barang.jual');
    // Route::post('/customer', 'CustomerController@search')->name('customer.data');
    // Route::post('/karyawan', 'KaryawanController@data')->name('karyawan.data');
    // Route::post('/production', 'ProductionController@data')->name('barang.data');
});
Route::prefix('payroll')->group(function(){
    Route::get('/absen', function () {
        return view('page.payroll.absen');
    })->name('payroll.absen');
    Route::get('/gaji', function () {
        return view('page.payroll.gaji');
    });
    Route::get('/detail/{id}', function ($id) {
        return view('page.payroll.detail', ['id' => $id]);
    });
    Route::get('/absenmasuk','App\Http\Controllers\KaryawanController@gaji')->name('payroll.gaji');
    Route::post('/absen/excel','App\Http\Controllers\KaryawanController@excel')->name('absen.excel');

});
Route::post('/karyawab/setting','App\Http\Controllers\KaryawanController@setting')->name('karyawan.setting');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});


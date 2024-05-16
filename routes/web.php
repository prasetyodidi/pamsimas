<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\datapelangganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\LoginPelangganController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganDashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\tagihanController;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('kerangka.master');
// });


Route::group(['prefix' => 'pelanggan/dashboard', 'middleware' => 'pelanggan'], function () {
    Route::get('/', [PelangganDashboardController::class, 'index'])->name('plg.dash.index');
    Route::get('tagihan', [PelangganDashboardController::class, 'tagihan'])->name('plg.dash.tagihan');
    Route::get('pembayaran', [PelangganDashboardController::class, 'pembayaran'])->name('plg.dash.pembayaran');
});

Route::get('/dashboard', [dashboardController::class, 'index']);

Route::get('/', [loginController::class, 'index'])->name('login');
Route::post('/log', [loginController::class, 'login'])->name('login.store');

Route::get('/register', [registerController::class, 'index'])->name('register');

Route::post('/regist', [registerController::class, 'store'])->name('register.store');

//data pelanggan
Route::group(['middleware' => 'auth:web'], function () {
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/excel/export', [LaporanController::class, 'excelExport'])->name('laporan.export.excel');
    Route::get('laporan/pdf/export', [LaporanController::class, 'pdfExport'])->name('laporan.export.pdf');
    Route::get('cari-tagihan', [tagihanController::class, 'cariTagihan'])->name('tagihan.cari');
});
// Route::get('/data-pelanggan', [datapelangganController::class, 'index'])->name('datapelanggan.index');
// Route::get('/create-pelanggan', [datapelangganController::class, 'create'])->name('datapelanggan.create');
// Route::post('/data-pelanggan', [datapelangganController::class, 'store'])->name('datapelanggan.store');
// Route::get('/data-pelanggan/{pelanggan}/edit', [datapelangganController::class, 'edit'])->name('datapelanggan.edit');
// Route::post('/data-pelanggan/{pelanggan}/update', [datapelangganController::class, 'update'])->name('datapelanggan.update');
// Route::delete('/data-pelanggan/{pelanggan}', [datapelangganController::class, 'destroy'])->name('datapelanggan.destroy');


//tagihan pelanggan
Route::get('/tagihan-pelanggan', [tagihanController::class, 'index'])->name('tagihan.index');
Route::get('/create-tagihan', [tagihanController::class, 'create'])->name('tagihan.create');
Route::post('/create-tagihan', [tagihanController::class, 'store'])->name('tagihan.store');
Route::get('/edit-tagihan', [tagihanController::class, 'edit'])->name('tagihan.edit');
Route::delete('/tagihan-pelanggan/{tagihan}', [tagihanController::class, 'destroy'])->name('tagihan.destroy');

Route::get('/login', [LoginPelangganController::class, 'show'])->name('plg.login.show');
Route::post('/login', [LoginPelangganController::class, 'login'])->name('plg.login');

Route::get('/midtrans/success', function () {
    return 'success!';
});

Route::post('tagihan/{id}/bayar', [MidtransController::class, 'checkout'])->name('tagihan.checkout');

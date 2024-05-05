<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\datapelangganController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\tagihanController;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('kerangka.master');
// });

Route::get('/dashboard', [dashboardController::class, 'index']);

Route::get('/', [loginController::class, 'index'])->name('login');
Route::post('/log', [loginController::class, 'login'])->name('login.store');

Route::get('/register', [registerController::class, 'index'])->name('register');

Route::post('/regist', [registerController::class, 'store'])->name('register.store');

//data pelanggan
Route::get('/data-pelanggan', [datapelangganController::class, 'index'])->name('datapelanggan.index');
Route::get('/create-pelanggan', [datapelangganController::class, 'create'])->name('datapelanggan.create');
Route::post('/data-pelanggan', [datapelangganController::class, 'store'])->name('datapelanggan.store');
Route::get('/data-pelanggan/{pelanggan}/edit', [datapelangganController::class, 'edit'])->name('datapelanggan.edit');
Route::post('/data-pelanggan/{pelanggan}/update', [datapelangganController::class, 'update'])->name('datapelanggan.update');
Route::delete('/data-pelanggan/{pelanggan}', [datapelangganController::class, 'destroy'])->name('datapelanggan.destroy');

//tagihan pelanggan
Route::get('/tagihan-pelanggan', [tagihanController::class, 'index'])->name('tagihan.index');
Route::get('/create-tagihan', [tagihanController::class, 'create'])->name('tagihan.create');
Route::post('/create-tagihan', [tagihanController::class, 'store'])->name('tagihan.store');
Route::get('/edit-tagihan', [tagihanController::class, 'edit'])->name('tagihan.edit');
Route::delete('/tagihan-pelanggan/{tagihan}', [tagihanController::class, 'destroy'])->name('tagihan.destroy');

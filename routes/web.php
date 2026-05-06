<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;

// Redirect root ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Barang
Route::resource('barang', BarangController::class);

// Kategori
Route::resource('kategori', KategoriController::class);

// Bantuan
Route::get('/bantuan', function () {
    return view('bantuan.index');
})->name('bantuan');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\SettingController;


// LOGIN
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');


// REGISTER
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');


// LOGOUT
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'admin'])->name('admin.dashboard');
    Route::resource('peminjam', PeminjamController::class);
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');
});


// PETUGAS
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('petugas/dashboard', [PetugasController::class, 'petugas'])->name('petugas.dashboard');
});


// PEMINJAM
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->group(function () {
    Route::get('peminjam/dashboard', [PeminjamanController::class, 'riwayat'])->name('peminjam.dashboard');
    Route::post('pinjam/buku/{id}', [PeminjamanController::class, 'pinjam'])->name('pinjam.buku');
});

// SEMUA ROLE
Route::middleware(['auth'])->group(function () {
    Route::resource('kategori', KategoriController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('peminjaman', PeminjamanController::class);

    Route::get('/laporan/peminjaman', [LaporanController::class, 'laporanPeminjaman'])
        ->name('laporan.peminjaman');

    Route::post('/ulasan/{id}', [UlasanController::class, 'store'])->name('ulasan.store');

    Route::post('/peminjaman/kembali/{id}', [PeminjamanController::class, 'kembalikan'])
    ->name('kembalikan.buku');
});
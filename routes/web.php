<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PeminjamanController;

//LOGIN
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');

//REGISTER
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');

//LOGOUT
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

//ADMIN AKSES
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::resource('peminjam', PeminjamController::class);
});

//PETUGAS AKSES
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard');
    })->name('petugas.dashboard');
}); 

//PEMINJAM AKSES
Route::middleware(['auth', 'role:peminjam'])->group(function () {
    Route::get('/peminjam/dashboard', function () { 
        return view('peminjam.dashboard');
    })->name('peminjam.dashboard');
});

//SEMUA AKSES
Route::resource('kategori', KategoriController::class);
Route::resource('buku', BukuController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::post('/peminjaman/kembali/{id}', [PeminjamanController::class, 'kembalikan'])
    ->name('kembalikan.buku');
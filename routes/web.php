<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\UmkmController;

/*
|--------------------------------------------------------------------------
| Web Routes - KBB GO!
|--------------------------------------------------------------------------
|
| Rute web untuk platform pariwisata dan UMKM Kabupaten Bandung Barat.
|
*/

// ---------------------------------------------------------------
// Halaman PUBLIK (bisa diakses tanpa login)
// ---------------------------------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// ---------------------------------------------------------------
// Authentication
// ---------------------------------------------------------------
// Hanya untuk tamu (belum login): register & login
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

// Logout wajib POST (dengan CSRF) dan hanya untuk yang sudah login
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ---------------------------------------------------------------
// Halaman WAJIB LOGIN (middleware auth)
// Tambah (create/store), ubah (edit/update), dan hapus (destroy)
// Catatan: grup ini harus didefinisikan SEBELUM rute index/show
// agar /destinasi/create tidak tertangkap oleh /destinasi/{destinasi}.
// ---------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::resource('destinasi', DestinasiController::class)
        ->except(['index', 'show']);

    Route::resource('umkm', UmkmController::class)
        ->except(['index', 'show']);
});

// Halaman publik: daftar & detail destinasi serta UMKM
Route::resource('destinasi', DestinasiController::class)->only(['index', 'show']);
Route::resource('umkm', UmkmController::class)->only(['index', 'show']);

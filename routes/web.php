<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\SiswaProfileController;

// Landing page
Route::get('/', fn() => view('welcome'))->name('home');

// Login routes
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::get('/login/siswa', [SiswaAuthController::class, 'showLoginForm'])->name('login.siswa');
    Route::post('/login/siswa', [SiswaAuthController::class, 'login'])->name('siswa.login');
    Route::get('/login/admin', [AdminAuthController::class, 'showLoginForm'])->name('login.admin');
    Route::post('/login/admin', [AdminAuthController::class, 'login'])->name('admin.login');
});

// Siswa routes
Route::middleware('auth:siswa')->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [PengaduanController::class, 'dashboard'])->name('dashboard');
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/histori', [PengaduanController::class, 'histori'])->name('histori');
    Route::get('/profile', [SiswaProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [SiswaProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [SiswaAuthController::class, 'logout'])->name('logout');
});

// Admin routes
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/kelola-pengaduan', [AdminController::class, 'kelolaPengaduan'])->name('kelola-pengaduan');
    Route::get('/pengaduan/{pengaduan}', [AdminController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{pengaduan}/status', [AdminController::class, 'updateStatus'])->name('pengaduan.status');
    Route::resource('siswa', AdminSiswaController::class);
    Route::resource('kategori', KategoriController::class);
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

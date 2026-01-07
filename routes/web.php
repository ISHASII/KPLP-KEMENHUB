<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananPublikController;
use App\Http\Controllers\LaporanPpidController;
use App\Http\Controllers\LaporanSkmController;
use App\Http\Controllers\LaporanMediaVisualController;
use App\Http\Controllers\LaporanBeritaKplpController;
use App\Http\Controllers\LaporanSiaranPersController;
use App\Http\Controllers\PengelolaanLaporanMasukController;
use App\Http\Controllers\UserManagementController;

// === ROUTE PUBLIK (Hanya boleh diakses kalau BELUM login) ===
Route::middleware('guest')->group(function () {
    Route::get('/login', [MainController::class, 'login'])->name('login');
    Route::post('/login', [MainController::class, 'processLogin']);
    Route::get('/refresh-captcha', [MainController::class, 'refreshCaptcha'])->name('refresh.captcha');
    Route::get('/register', [MainController::class, 'register'])->name('register');

    // Forgot Password Routes
    Route::get('/forgot-password', [MainController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [MainController::class, 'processForgotPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [MainController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [MainController::class, 'processResetPassword'])->name('password.update');
});

// === ROUTE YANG PERLU LOGIN (Protected) ===
Route::middleware('auth')->group(function () {

    // Dashboard (root URL setelah login)
    Route::get('/', [MainController::class, 'index'])->name('dashboard');

    // Logout (tetap bisa diakses semua user yang sudah login)
    Route::post('/logout', [MainController::class, 'logout'])->name('logout');
});

// === ROUTE KHUSUS ADMIN (Protected by admin middleware) ===
Route::middleware(['auth', 'admin'])->group(function () {
    // Shipping
    Route::get('/shipping', [MainController::class, 'shipping'])->name('shipping');

    // Layanan Publik
    Route::resource('layanan-publik', LayananPublikController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // Laporan PPID
    Route::get('/laporan-ppid', [LaporanPpidController::class, 'index'])->name('ppid.index');
    Route::post('/laporan-ppid/store', [LaporanPpidController::class, 'store'])->name('ppid.store');
    Route::put('/laporan-ppid/{id}', [LaporanPpidController::class, 'update'])->name('ppid.update');
    Route::delete('/laporan-ppid/{id}', [LaporanPpidController::class, 'destroy'])->name('ppid.destroy');

    // Laporan SKM
    Route::get('/laporan-skm', [LaporanSkmController::class, 'index'])->name('skm.index');
    Route::post('/laporan-skm/store', [LaporanSkmController::class, 'store'])->name('skm.store');
    Route::put('/laporan-skm/{id}', [LaporanSkmController::class, 'update'])->name('skm.update');
    Route::delete('/laporan-skm/{id}', [LaporanSkmController::class, 'destroy'])->name('skm.destroy');

    // Laporan Media Visual
    Route::get('/laporan-media-visual', [LaporanMediaVisualController::class, 'index'])->name('media_visual.index');
    Route::post('/laporan-media-visual/store', [LaporanMediaVisualController::class, 'store'])->name('media_visual.store');
    Route::put('/laporan-media-visual/{id}', [LaporanMediaVisualController::class, 'update'])->name('media_visual.update');
    Route::delete('/laporan-media-visual/{id}', [LaporanMediaVisualController::class, 'destroy'])->name('media_visual.destroy');

    // Laporan Berita KPLP
    Route::get('/laporan-berita-kplp', [LaporanBeritaKplpController::class, 'index'])->name('berita_kplp.index');
    Route::post('/laporan-berita-kplp/store', [LaporanBeritaKplpController::class, 'store'])->name('berita_kplp.store');
    Route::put('/laporan-berita-kplp/{id}', [LaporanBeritaKplpController::class, 'update'])->name('berita_kplp.update');
    Route::delete('/laporan-berita-kplp/{id}', [LaporanBeritaKplpController::class, 'destroy'])->name('berita_kplp.destroy');

    // Laporan Siaran Pers
    Route::get('/laporan-siaran-pers', [LaporanSiaranPersController::class, 'index'])->name('siaran_pers.index');
    Route::post('/laporan-siaran-pers/store', [LaporanSiaranPersController::class, 'store'])->name('siaran_pers.store');
    Route::put('/laporan-siaran-pers/{id}', [LaporanSiaranPersController::class, 'update'])->name('siaran_pers.update');
    Route::delete('/laporan-siaran-pers/{id}', [LaporanSiaranPersController::class, 'destroy'])->name('siaran_pers.destroy');

    // Pengelolaan Laporan Masuk
    Route::get('/pengelolaan-laporan-masuk', [PengelolaanLaporanMasukController::class, 'index'])->name('laporan_masuk.index');
    Route::post('/pengelolaan-laporan-masuk/store', [PengelolaanLaporanMasukController::class, 'store'])->name('laporan_masuk.store');
    Route::put('/pengelolaan-laporan-masuk/{id}', [PengelolaanLaporanMasukController::class, 'update'])->name('laporan_masuk.update');
    Route::delete('/pengelolaan-laporan-masuk/{id}', [PengelolaanLaporanMasukController::class, 'destroy'])->name('laporan_masuk.destroy');

    // Kelola Akun (User Management) - Hanya Admin yang bisa akses
    Route::get('/kelola-akun', [UserManagementController::class, 'index'])->name('users.index');
    Route::post('/kelola-akun/store', [UserManagementController::class, 'store'])->name('users.store');
    Route::put('/kelola-akun/{id}', [UserManagementController::class, 'update'])->name('users.update');
    Route::patch('/kelola-akun/{id}/toggle-status', [UserManagementController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::delete('/kelola-akun/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');
});

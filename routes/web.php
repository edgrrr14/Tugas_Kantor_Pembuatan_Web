<?php

/*
|--------------------------------------------------------------------------
| Web Routes - Sertifikasi Elektronik
|--------------------------------------------------------------------------
|
| Di sini semua route web untuk aplikasi Sertifikasi Elektronik didefinisikan.
| Semua route ini di-load oleh RouteServiceProvider dan di-assign
| ke dalam middleware group "web".
|
*/

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// =============================================================
// HALAMAN UTAMA / LANDING PAGE
// =============================================================

/**
 * Route: GET /
 * Menampilkan halaman Landing Page utama dengan menu navigasi 4 kartu.
 */
Route::get('/', [CertificationController::class, 'index'])->name('home');

// =============================================================
// HALAMAN FORM PENERBITAN SERTIFIKAT
// =============================================================

/**
 * Route: GET /penerbitan
 * Menampilkan form pengajuan penerbitan sertifikat baru.
 */
Route::get('/penerbitan', [CertificationController::class, 'penerbitan'])->name('penerbitan');

/**
 * Route: POST /penerbitan
 * Memproses dan menyimpan data pengajuan penerbitan sertifikat.
 */
Route::post('/penerbitan', [CertificationController::class, 'storePenerbitan'])->name('penerbitan.store');

// =============================================================
// HALAMAN FORM PEMBARUAN SERTIFIKAT
// =============================================================

/**
 * Route: GET /pembaruan
 * Menampilkan form pengajuan pembaruan/perpanjangan sertifikat lama.
 */
Route::get('/pembaruan', [CertificationController::class, 'pembaruan'])->name('pembaruan');

/**
 * Route: POST /pembaruan
 * Memproses dan menyimpan data pengajuan pembaruan sertifikat.
 */
Route::post('/pembaruan', [CertificationController::class, 'storePembaruan'])->name('pembaruan.store');

// =============================================================
// HALAMAN INFORMASI WEB
// =============================================================

/**
 * Route: GET /informasi
 * Menampilkan halaman informasi lengkap tentang website sertifikasi elektronik.
 */
Route::get('/informasi', [CertificationController::class, 'informasi'])->name('informasi');

/**
 * Route: POST /helpdesk
 * Memproses dan menyimpan data pertanyaan helpdesk user.
 */
Route::post('/helpdesk', [CertificationController::class, 'storeHelpdesk'])->name('helpdesk.store');

// =============================================================
// ADMIN ROLE & PANEL ROUTES (Flowchart Utama Admin)
// =============================================================

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Rute Akses Publik Admin (Login)
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('authenticate');

    // Rute Terproteksi Admin (Wajib Login Admin)
    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Dashboard Utama Admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Kelola Status Pengajuan
        Route::post('/penerbitan/{id}/status', [AdminController::class, 'updateStatusPenerbitan'])->name('penerbitan.status');
        Route::post('/pembaruan/{id}/status', [AdminController::class, 'updateStatusPembaruan'])->name('pembaruan.status');
        Route::post('/helpdesk/{id}/status', [AdminController::class, 'updateStatusHelpdesk'])->name('helpdesk.status');
        Route::delete('/helpdesk/{id}', [AdminController::class, 'destroyHelpdesk'])->name('helpdesk.destroy');

        // Kelola Dokumen Syarat (Penerbitan & Pembaruan)
        Route::post('/dokumen-syarat', [AdminController::class, 'storeDokumenSyarat'])->name('dokumen_syarat.store');
        Route::post('/dokumen-syarat/{id}', [AdminController::class, 'updateDokumenSyarat'])->name('dokumen_syarat.update');
        Route::delete('/dokumen-syarat/{id}', [AdminController::class, 'destroyDokumenSyarat'])->name('dokumen_syarat.destroy');

        // Ekspor Data Laporan
        Route::get('/export/penerbitan/csv', [AdminController::class, 'exportPenerbitanCSV'])->name('export.penerbitan.csv');
    });
});

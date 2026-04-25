<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route untuk menampilkan form login
Route::get('/', function () {
    return view('login');
})->name('login');

// Route untuk memproses data form yang dikirim (inilah yang dicari oleh Laravel tadi!)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Route untuk menampilkan Dashboard Admin (Mengganti teks sementara tadi)
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // Memanggil file admin/dashboard.blade.php
})->name('admin.dashboard');

// URL-nya kita ubah jadi /admin/bulk-delete-mahasiswa (tanpa garis miring di tengah)
Route::delete('/admin/bulk-delete-mahasiswa', [\App\Http\Controllers\AdminController::class, 'bulkDeleteMahasiswa'])->name('admin.mahasiswa.bulk_delete');

Route::post('/admin/store-user', [\App\Http\Controllers\AdminController::class, 'storeUserManual'])->name('admin.store.user');
// Route untuk memproses Form Generate Akun
Route::post('/admin/generate-mahasiswa', [\App\Http\Controllers\AdminController::class, 'generateMahasiswaMassal'])->name('admin.generate.mahasiswa');

// Route untuk memproses generate akun satuan
Route::post('/admin/store-user', [\App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.store.user');

// Route untuk manajemen laci
Route::get('/admin/laci', [\App\Http\Controllers\AdminController::class, 'laciIndex'])->name('admin.laci.index');
Route::post('/admin/laci', [\App\Http\Controllers\AdminController::class, 'laciStore'])->name('admin.laci.store');
Route::delete('/admin/laci/{id}', [\App\Http\Controllers\AdminController::class, 'laciDestroy'])->name('admin.laci.destroy');

Route::get('/admin/mahasiswa', [\App\Http\Controllers\AdminController::class, 'mahasiswaIndex'])->name('admin.mahasiswa.index');
Route::post('/admin/mahasiswa/reset/{id}', [\App\Http\Controllers\AdminController::class, 'resetPassword'])->name('admin.mahasiswa.reset');
Route::delete('/admin/mahasiswa/{id}', [\App\Http\Controllers\AdminController::class, 'destroyUser'])->name('admin.mahasiswa.destroy');


// Route untuk manajemen dosen
Route::get('/admin/dosen', [\App\Http\Controllers\AdminController::class, 'dosenIndex'])->name('admin.dosen.index');
Route::post('/admin/dosen/reset/{id}', [\App\Http\Controllers\AdminController::class, 'resetPasswordDosen'])->name('admin.dosen.reset');
Route::delete('/admin/dosen/{id}', [App\Http\Controllers\AdminController::class, 'destroyUser'])->name('admin.dosen.destroy');

// Rute untuk Buka Arsip Mahasiswa (Admin)
Route::get('/admin/mahasiswa/{id}/arsip', [\App\Http\Controllers\AdminController::class, 'arsipMahasiswa'])->name('admin.mahasiswa.arsip');

// Rute untuk Review Dokumen via Admin
Route::post('/admin/dokumen/{id}/status', [\App\Http\Controllers\AdminController::class, 'updateStatusDokumen'])->name('admin.dokumen.status');

// Rute untuk Hapus Dokumen via Admin
Route::delete('/admin/dokumen/{id}', [\App\Http\Controllers\AdminController::class, 'destroyDokumen'])->name('admin.dokumen.destroy');

// Rute untuk mengunduh file oleh Admin
Route::get('/admin/download/{id}', [App\Http\Controllers\AdminController::class, 'download'])->name('admin.download');

// Rute untuk melihat file oleh Admin
Route::get('/admin/dokumen/{id}/preview', [App\Http\Controllers\AdminController::class, 'preview'])->name('admin.preview');

use App\Http\Controllers\DosenController;

Route::get('/dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
Route::get('/dosen/download/{id}', [DosenController::class, 'download'])->name('dosen.download');
Route::post('/dosen/update-status/{id}', [DosenController::class, 'updateStatus'])->name('dosen.status');
Route::get('/dosen/mahasiswa', [\App\Http\Controllers\DosenController::class, 'mahasiswaIndex'])->name('dosen.mahasiswa.index');
Route::get('/dosen/mahasiswa/{id}/arsip', [\App\Http\Controllers\DosenController::class, 'arsipMahasiswa'])->name('dosen.mahasiswa.arsip');
Route::get('/dosen/dokumen/{id}/preview', [App\Http\Controllers\DosenController::class, 'preview'])->name('dosen.preview');

Route::get('/mahasiswa/dashboard', [\App\Http\Controllers\MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
Route::post('/mahasiswa/upload', [\App\Http\Controllers\MahasiswaController::class, 'upload'])->name('mahasiswa.upload');
Route::get('/mahasiswa/berkas', [\App\Http\Controllers\MahasiswaController::class, 'berkasSaya'])->name('mahasiswa.berkas');
Route::get('/mahasiswa/riwayat', [\App\Http\Controllers\MahasiswaController::class, 'riwayatBerkas'])->name('mahasiswa.riwayat');
Route::delete('/mahasiswa/berkas/{id}', [\App\Http\Controllers\MahasiswaController::class, 'hapusBerkas'])->name('mahasiswa.hapus');
Route::get('/mahasiswa/download/{id}', [\App\Http\Controllers\MahasiswaController::class, 'downloadBerkas'])->name('mahasiswa.download');
Route::post('/mahasiswa/update-nama', [\App\Http\Controllers\MahasiswaController::class, 'updateNama'])->name('mahasiswa.update_nama');
Route::get('/mahasiswa/dokumen/{id}/preview', [App\Http\Controllers\MahasiswaController::class, 'previewBerkas'])->name('mahasiswa.preview');
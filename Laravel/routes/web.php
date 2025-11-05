<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrtuController;

// Swagger UI Route
Route::get('/api/docs', function () {
    return view('l5-swagger::index');
});

Route::get('/', function () {
    return view('login');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/absensi', [AdminController::class, 'absensi'])->name('admin.absensi');
    Route::get('/nilai', [AdminController::class, 'nilai'])->name('admin.nilai');
    Route::get('/cek_nilai', [AdminController::class, 'cek_nilai'])->name('admin.cek_nilai');
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/data_guru', [AdminController::class, 'data_guru'])->name('admin.data_guru');
    Route::get('/data_orangtua', [AdminController::class, 'data_orangtua'])->name('admin.data_orangtua');
    Route::get('/data_siswa', [AdminController::class, 'data_siswa'])->name('admin.data_siswa');
    Route::get('/data_kelas', [AdminController::class, 'data_kelas'])->name('admin.data_kelas');
    Route::get('/data_mapel', [AdminController::class, 'data_mapel'])->name('admin.data_mapel');
    Route::get('/data_akademik', [AdminController::class, 'data_akademik'])->name('admin.data_akademik');
    Route::get('/tambah_guru', [AdminController::class, 'tambah_guru'])->name('admin.tambah_guru');
    Route::get('/tambah_orangtua', [AdminController::class, 'tambah_orangtua'])->name('admin.tambah_orangtua');
    Route::get('/tambah_siswa', [AdminController::class, 'tambah_siswa'])->name('admin.tambah_siswa');
    Route::get('/tambah_kelas', [AdminController::class, 'tambah_kelas'])->name('admin.tambah_kelas');
    Route::get('/tambah_mapel', [AdminController::class, 'tambah_mapel'])->name('admin.tambah_mapel');
    Route::get('/tambah_akademik', [AdminController::class, 'tambah_akademik'])->name('admin.tambah_akademik');
    Route::put('/guru/{id}', [AdminController::class, 'update_guru'])->name('admin.update_guru');
    Route::get('/guru/{id}/edit', [AdminController::class, 'edit_guru'])->name('admin.edit_guru');
    Route::get('/orangtua/{id}/edit', [AdminController::class, 'edit_orangtua'])->name('admin.edit_orangtua');
    Route::put('/orangtua/{id}', [AdminController::class, 'update_orangtua'])->name('admin.update_orangtua');
    Route::get('/kelas/{id}/edit', [AdminController::class, 'edit_kelas'])->name('admin.edit_kelas');
    Route::put('/kelas/{id}', [AdminController::class, 'update_kelas'])->name('admin.update_kelas');
    Route::get('/admin/edit_mapel/{id}', [AdminController::class, 'edit_mapel'])->name('admin.edit_mapel');
    Route::put('/admin/update_mapel/{id}', [AdminController::class, 'update_mapel'])->name('admin.update_mapel');
});

Route::prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/absensi', [GuruController::class, 'absensi'])->name('guru.absensi');
    Route::get('/nilai', [GuruController::class, 'nilai'])->name('guru.nilai');
    Route::get('/cek_nilai', [GuruController::class, 'cek_nilai'])->name('guru.cek_nilai');
    Route::get('/input_nilai', [GuruController::class, 'input_nilai'])->name('guru.input_nilai');
    Route::get('/laporan', [GuruController::class, 'laporan'])->name('guru.laporan');
});

Route::prefix('ortu')->group(function () {
    Route::get('/dashboard', [OrtuController::class, 'dashboard'])->name('ortu.dashboard');
    Route::get('/absensi', [OrtuController::class, 'absensi'])->name('ortu.absensi');
    Route::get('/nilai', [OrtuController::class, 'nilai'])->name('ortu.nilai');
    Route::get('/laporan', [OrtuController::class, 'laporan'])->name('ortu.laporan');
});

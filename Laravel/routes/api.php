<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\GuruController;
use App\Http\Controllers\API\OrtuController;

// ==================== AUTH ====================
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// ==================== ADMIN ====================
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/absensi', [AdminController::class, 'absensi']);
    Route::get('/admin/nilai', [AdminController::class, 'nilai']);
    Route::get('/admin/getNilai', [AdminController::class, 'getNilai']);
    Route::get('/admin/laporan', [AdminController::class, 'laporan']);
    Route::get('/admin/guru', [AdminController::class, 'getGuru']);
    Route::get('/admin/siswa', [AdminController::class, 'getSiswa']);
    Route::get('/admin/ortu', [AdminController::class, 'getOrtu']);

    Route::post('/admin/addGuru', [AdminController::class, 'addGuru']);
    Route::post('/admin/addSiswa', [AdminController::class, 'addSiswa']);
    Route::post('/admin/addOrtu', [AdminController::class, 'addOrtu']);
});

// ==================== GURU ====================
Route::middleware(['auth:sanctum', 'role:guru'])->group(function () {

    Route::get('/guru/dashboard', [GuruController::class, 'dashboard']);
    Route::get('/guru/siswa-nilai', [GuruController::class, 'getSiswaUntukNilai']);
    Route::get('/guru/nilai-siswa/{id}', [GuruController::class, 'getNilaiSiswa']);
    Route::get('/guru/laporan-akademik', [GuruController::class, 'laporanAkademik']);

    Route::put('/guru/absensi/{id}', [GuruController::class, 'updateAbsensi']);

    Route::post('/guru/nilai', [GuruController::class, 'inputNilai']);
});

// ==================== ORTU ====================
Route::middleware(['auth:sanctum', 'role:ortu'])->group(function () {
    Route::get('/orangtua/dashboard', [OrtuController::class, 'dashboard']);
    Route::get('/orangtua/laporan', [OrtuController::class, 'laporanAkademik']);
    Route::get('/orangtua/nilai-anak', [OrtuController::class, 'getNilaiAnak']);
});


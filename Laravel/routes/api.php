<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\GuruController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/
//Auth Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
// ==================== ADMIN ROUTES ====================
//GET Routes
Route::middleware(['role:admin'])->get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::middleware(['role:admin'])->get('/admin/absensi', [AdminController::class, 'absensi']);
Route::middleware(['role:admin'])->get('/admin/nilai', [AdminController::class, 'nilai']);
Route::middleware(['role:admin'])->get('/admin/getNilai', [AdminController::class, 'getNilai']);
Route::middleware(['role:admin'])->get('/admin/laporan', [AdminController::class, 'laporan']);
Route::middleware(['role:admin'])->get('/admin/laporan', [AdminController::class, 'laporan']);
Route::middleware(['role:admin'])->get('/admin/guru', [AdminController::class, 'getGuru']);
Route::middleware(['role:admin'])->get('/admin/siswa', [AdminController::class, 'getSiswa']);
Route::middleware(['role:admin'])->get('/admin/ortu', [AdminController::class, 'getOrtu']);
// POST Routes 
Route::middleware(['role:admin'])->post('/admin/addGuru', [AdminController::class, 'addGuru']);
Route::middleware(['role:admin'])->post('/admin/addSiswa', [AdminController::class, 'addSiswa']);
Route::middleware(['role:admin'])->post('/admin/addOrtu', [AdminController::class, 'addOrtu']);

// ==================== GURU ROUTES ====================
//GET Routes
Route::get('/guru/dashboard', [GuruController::class, 'dashboard']);
Route::get('/guru/siswa-nilai', [GuruController::class, 'getSiswaUntukNilai']);
Route::get('/guru/nilai-siswa/{id}', [GuruController::class, 'getNilaiSiswa']);
Route::get('/guru/laporan-akademik', [GuruController::class, 'laporanAkademik']);
// PUT Routes
Route::put('/guru/absensi/{id}', [GuruController::class, 'updateAbsensi']);
// POST Routes
Route::post('/guru/nilai', [GuruController::class, 'inputNilai']);


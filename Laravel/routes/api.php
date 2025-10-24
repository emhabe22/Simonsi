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
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('auth:api');
Route::get('/admin/absensi', [AdminController::class, 'absensi'])->middleware('auth:api');
Route::get('/admin/nilai', [AdminController::class, 'nilai'])->middleware('auth:api');
Route::get('/admin/getNilai', [AdminController::class, 'getNilai'])->middleware('auth:api');
Route::get('/admin/laporan', [AdminController::class, 'laporan'])->middleware('auth:api');
Route::get('/admin/laporan', [AdminController::class, 'laporan'])->middleware('auth:api');
Route::get('/admin/guru', [AdminController::class, 'getGuru'])->middleware('auth:api');
Route::get('/admin/siswa', [AdminController::class, 'getSiswa'])->middleware('auth:api');
Route::get('/admin/ortu', [AdminController::class, 'getOrtu'])->middleware('auth:api');
// POST Routes 
Route::post('/admin/addGuru', [AdminController::class, 'addGuru'])->middleware('auth:api');
Route::post('/admin/addSiswa', [AdminController::class, 'addSiswa'])->middleware('auth:api');
Route::post('/admin/addOrtu', [AdminController::class, 'addOrtu'])->middleware('auth:api');

// ==================== GURU ROUTES ====================
//GET Routes
Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->middleware('auth:api');
Route::get('/guru/siswa-nilai', [GuruController::class, 'getSiswaUntukNilai'])->middleware('auth:api');
Route::get('/guru/nilai-siswa/{id}', [GuruController::class, 'getNilaiSiswa'])->middleware('auth:api');
Route::get('/guru/laporan-akademik', [GuruController::class, 'laporanAkademik'])->middleware('auth:api');
// PUT Routes
Route::put('/guru/absensi/{id}', [GuruController::class, 'updateAbsensi'])->middleware('auth:api');
// POST Routes
Route::post('/guru/nilai', [GuruController::class, 'inputNilai'])->middleware('auth:api');


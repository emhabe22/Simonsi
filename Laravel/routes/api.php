<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Semua endpoint API kamu daftarkan di sini.
| File ini otomatis di-load oleh RouteServiceProvider.
|
*/
//Auth Routes
Route::post('/login', [AuthController::class, 'login']);
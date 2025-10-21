<?php

use Illuminate\Support\Facades\Route;

// Swagger UI Route
Route::get('/api/docs', function () {
    return view('l5-swagger::index');
});


Route::get('/', function () {
    return view('welcome');
});

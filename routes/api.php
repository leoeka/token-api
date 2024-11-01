<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;

// Route untuk registrasi dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route Mahasiswa dengan middleware peran
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/mahasiswas', [MahasiswaController::class, 'index']);
    Route::middleware('role:admin')->group(function () {
        Route::post('/mahasiswas', [MahasiswaController::class, 'store']);
        Route::get('/mahasiswas/{id}', [MahasiswaController::class, 'show']);
        Route::put('/mahasiswas/{id}', [MahasiswaController::class, 'update']);
        Route::delete('/mahasiswas/{id}', [MahasiswaController::class, 'destroy']);
    });
});
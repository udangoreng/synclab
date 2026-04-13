<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/mahasiswa', [AuthController::class, 'mahasiswa'])->middleware('checkRole:Praktikan');
    Route::get('/dosen', [AuthController::class, 'dosen'])->middleware('checkRole:dosen');
    Route::get('/asisten', [AuthController::class, 'asisten'])->middleware('checkRole:asisten');
    Route::get('/admin', [AuthController::class, 'welcome'])->middleware('checkRole:admin');

    // Laboratorium routes 
    Route::get('/api/laboratorium', [LaboratoriumController::class, 'index']);
    Route::get('/api/laboratorium/{id}', [LaboratoriumController::class, 'show']);
    Route::post('/api/laboratorium', [LaboratoriumController::class, 'store'])->middleware('checkRole:admin');
    Route::put('/api/laboratorium/{id}', [LaboratoriumController::class, 'update'])->middleware('checkRole:admin');
    Route::delete('/api/laboratorium/{id}', [LaboratoriumController::class, 'destroy'])->middleware('checkRole:admin');

    // Nilai routes 
    Route::get('/api/nilai', [NilaiController::class, 'index']);
    Route::get('/api/nilai/{id}', [NilaiController::class, 'show']);
    Route::post('/api/nilai', [NilaiController::class, 'store']);
    Route::put('/api/nilai/{id}', [NilaiController::class, 'update']);
    Route::delete('/api/nilai/{id}', [NilaiController::class, 'destroy']);
    Route::get('/api/nilai/praktikum/{idPraktikum}', [NilaiController::class, 'getByPraktikum']);
    Route::get('/api/nilai/user/{userId}', [NilaiController::class, 'getByUser']);

    // Presensi routes 
    Route::get('/api/presensi', [PresensiController::class, 'index']);
    Route::get('/api/presensi/{id}', [PresensiController::class, 'show']);
    Route::post('/api/presensi', [PresensiController::class, 'store']);
    Route::put('/api/presensi/{id}', [PresensiController::class, 'update']);
    Route::delete('/api/presensi/{id}', [PresensiController::class, 'destroy']);
    Route::get('/api/presensi/praktikum/{idPraktikum}', [PresensiController::class, 'getByPraktikum']);
    Route::get('/api/presensi/user/{userId}', [PresensiController::class, 'getByUser']);
});
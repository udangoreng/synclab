<?php

use App\Http\Controllers\AuthController;
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
});
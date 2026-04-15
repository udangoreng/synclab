<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PraktikumController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\PretestController;
use App\Http\Controllers\LaporanController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/mahasiswa', [AuthController::class, 'mahasiswa'])->middleware('checkRole:Praktikan')->name('mahasiswa');
    Route::get('/dosen', [AuthController::class, 'dosen'])->middleware('checkRole:Dosen')->name('dosen');
    Route::get('/asisten', [AuthController::class, 'asisten'])->middleware('checkRole:Asisten')->name('asisten');
    Route::get('/admin', [AuthController::class, 'welcome'])->middleware('checkRole:admin');

    Route::prefix('mahasiswa')->group(function () {
        Route::get('/pendaftaran', [PraktikumController::class, 'pendaftaranShow'])->name('pendaftaran');
        Route::get('/praktikum', [PraktikumController::class, 'getMyPraktikum'])->name('praktikum');
        Route::get('/pretest', [MahasiswaController::class, 'getMyPretest'])->name('pretest');
        Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');
        Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi');
        Route::get('/riwayat', [MahasiswaController::class, 'getMyHistory'])->name('riwayat');
    });

    Route::prefix('dosen')->group(function () {
        Route::get('/monitoring', [PraktikumController::class, 'monitoringPraktikum'])->name('monitoring');
        Route::get('/validasi', [NilaiController::class, 'index'])->name('validasiNilai');
        Route::get('/presensi', [PresensiController::class, 'index'])->name('cekPresensi');
        Route::get('/pendaftaran', [PraktikumController::class, 'cekStatusPendaftaran'])->name('cekPendaftaran');
    });

    Route::prefix('asisten')->group(function () {
        Route::get('/praktikum', [PraktikumController::class, 'asistensiPraktikum'])->name('asistensi');
        Route::get('/presensi', [PresensiController::class, 'index'])->name('konfirmasiPresensi');
        Route::get('/presensi/history', [PresensiController::class, 'getHistoryPresensi'])->name('riwayatPresensi');
        Route::get('/modul', [ModulController::class, 'addModul'])->name('addModul');
        Route::get('/pretest', [PretestController::class, 'addPretest'])->name('addPretest');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('nilaiLaporan');
        Route::get('/nilai', [NilaiController::class, 'index'])->name('addNilai');
        Route::get('/nilai/rekap', [NilaiController::class, 'rekapNilai'])->name('rekapNilai');
        Route::get('/mahasiswa', [MahasiswaController::class, 'getMahasiswa'])->name('seeMahasiswa');
    });

    // Laboratorium routes 
    Route::get('/api/laboratorium', [LaboratoriumController::class, 'index']);
    Route::get('/api/laboratorium/{id}', [LaboratoriumController::class, 'show']);
    Route::post('/api/laboratorium', [LaboratoriumController::class, 'store'])->middleware('checkRole:admin');
    Route::put('/api/laboratorium/{id}', [LaboratoriumController::class, 'update'])->middleware('checkRole:admin');
    Route::delete('/api/laboratorium/{id}', [LaboratoriumController::class, 'destroy'])->middleware('checkRole:admin');

    // Nilai routes 
    // Route::get('/api/nilai', [NilaiController::class, 'index']);
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
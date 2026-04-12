<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mahasiswa/dashboard');
});
Route::get('/c', function () {
    return view('mahasiswa/praktikum');
});
Route::get('/d', function () {
    return view('mahasiswa/pendaftaran');
});
Route::get('/a', function () {
    return view('mahasiswa/presensi');
});
Route::get('/t', function () {
    return view('mahasiswa/pretest');
});
Route::get('/r', function () {
    return view('mahasiswa/riwayat');
});
Route::get('/n', function () {
    return view('mahasiswa/nilai');
});

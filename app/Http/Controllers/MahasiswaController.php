<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    function getMyPretest() {
        return view('mahasiswa/pretest');
    }

    function getMyHistory() {
        return view('mahasiswa/riwayat');
    }

    function getMahasiswa() {
        return view('asisten/mahasiswa_asisten');
    }
}

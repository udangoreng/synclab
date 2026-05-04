<?php

namespace App\Http\Controllers;

use App\Models\Praktikum;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Praktikum $praktikum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Praktikum $praktikum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Praktikum $praktikum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Praktikum $praktikum)
    {
        //
    }

    function pendaftaranShow()
    {
        // Get all available praktikums for registration
        $praktikums = Praktikum::with('jadwals.laboratorium', 'jadwals.dosen')->get();
        $user = Auth::user();
        
        // Get user's registrations
        $myPraktikums = Praktikum::whereHas('nilais', function($query) use ($user) {
            $query->where('id_user', $user->id);
        })->get();
        
        return view('mahasiswa/pendaftaran', compact('praktikums', 'myPraktikums'));
    }

    function getMyPraktikum()
    {
        $user = Auth::user();
        
        // Get praktikums where user has nilai (registered)
        $myPraktikums = Praktikum::whereHas('jadwals.pertemuan.nilais', function($query) use ($user) {
            $query->where('id_user', $user->id);
        })->with([
            'jadwals.laboratorium', 
            'jadwals.dosen',
            'jadwals.pertemuans.modul',
            'jadwals.pertemuans.nilais' => function($q) use ($user) {
                $q->where('id_user', $user->id);
            }
        ])->get();
        
        // Get all available praktikums
        $allPraktikums = Praktikum::with([
            'jadwals.laboratorium', 
            'jadwals.dosen',
            'jadwals.pertemuans.modul'
        ])->get();
        
        return view('mahasiswa/praktikum', compact('myPraktikums', 'allPraktikums'));
    }

    function monitoringPraktikum()
    {
        return view('dosen/monitoring');
    }

    function cekStatusPendaftaran()
    {
        return view('dosen/statuspendaftaran');
    }

    function asistensiPraktikum()
    {
        return view('asisten/praktikum_asisten');
    }

    public function masterPraktikum()
    {
        return view('laboran/kelolaPraktikum_lab');
    }

    public function masterMonitoring()
    {
        return view('laboran/monitoring_lab');
    }
}

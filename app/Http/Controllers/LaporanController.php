<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Laporan;
use App\Models\Nilai;
use App\Models\Presensi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('asisten/laporan_asisten');
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
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        //
    }

    public function masterLaporan()
    {
        $nilaiLatest = Nilai::with('users')->latest()->limit(5)->get();
        $nilai = Nilai::all();
        $bentrokCount = 0;
        $labSchedule = [];

        $presKon = Presensi::where('status', 'Dikonfirmasi')->count();
        $presAll = Presensi::all()->count();

        $persenPresen = ($presKon/($presAll>0 ? $presAll : 1))*100;
        
        $nilaiKon = Nilai::where('status', 'Dikonfirmasi')->count();
        $nilaiAll = Nilai::all()->count();


        $persenNilai = ($nilaiKon/($nilaiAll>0 ? $nilaiAll : 1))*100;

        $jadwalQuery = Jadwal::with(['praktikum', 'laboratorium', 'dosen']);
        $jadwals = $jadwalQuery->orderBy('jam_mulai', 'asc')->get();

        foreach ($jadwals as $jadwal) {
            $key = $jadwal->jam_mulai . '-' . $jadwal->id_laboratorium;
            if (isset($labSchedule[$key])) {
                $jadwal->bentrok = true;
                $bentrokCount++;
                $warningsJadwal = "Lab {$jadwal->laboratorium->nama_laboratorium} digunakan 2 jadwal di jam yang sama";
            } else {
                $jadwal->bentrok = false;
                $labSchedule[$key] = true;
            }
        }

        return view('laboran/laporan_lab', compact('nilai', 'nilaiLatest', 'bentrokCount', 'persenPresen', 'persenNilai'));
    }
}

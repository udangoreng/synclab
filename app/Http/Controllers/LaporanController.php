<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Laporan;
use App\Models\Nilai;
use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Models\Pertemuan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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

    public function adminShowLaporan(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        
        // Query menggunakan DB Builder untuk pengumpulan_laporan
        $query = DB::table('pengumpulan_laporan')
            ->leftJoin('pertemuans', 'pengumpulan_laporan.id_pertemuan', '=', 'pertemuans.id')
            ->leftJoin('users', 'pengumpulan_laporan.id_user', '=', 'users.id')
            ->select(
                'pengumpulan_laporan.*',
                'pertemuans.nama as pertemuan_nama',
                'users.name as user_name',
                'users.nomor_induk as user_nomor_induk'
            );
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                  ->orWhere('users.nomor_induk', 'like', "%{$search}%")
                  ->orWhere('pertemuans.nama', 'like', "%{$search}%");
            });
        }
        
        // Apply status filter
        if ($status) {
            $query->where('pengumpulan_laporan.status', $status);
        }
        
        $pengumpulanLaporans = $query->orderBy('pengumpulan_laporan.created_at', 'desc')
            ->paginate(10)
            ->through(function ($item) {
                // Convert to object with proper casting
                $item->id = (int) $item->id;
                $item->id_pertemuan = (int) $item->id_pertemuan;
                $item->id_user = (int) $item->id_user;
                $item->nilai = $item->nilai ? (float) $item->nilai : null;
                return $item;
            });
        
        // Get data for dropdowns
        $pertemuans = Pertemuan::all();
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        
        return view('laboran.kelolaLaporan', compact('pengumpulanLaporans', 'pertemuans', 'mahasiswas'));
    }
}

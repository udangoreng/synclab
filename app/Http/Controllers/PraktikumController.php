<?php

namespace App\Http\Controllers;

use App\Models\Praktikum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Jadwal;

class PraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $praktikums = Praktikum::when($request->search, function ($query, $search) {
            return $query->where('kode_praktikum', 'like', "%{$search}%")
                ->orWhere('nama_praktikum', 'like', "%{$search}%");
        })->with('jadwals', 'jadwals.laboratorium', 'asisten', 'mahasiswa')->paginate(15);

        return view('laboran/kelolaPraktikum_lab', compact('praktikums'));
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
        $request->validate([
            'kode_praktikum' => 'required|string|max:255|unique:praktikums',
            'nama_praktikum' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
        ], [
            'kode_praktikum.unique' => 'Kode Ini Telah Dipakai, Harap Mengunakan Kode Lain.',
            'kode_praktikum.required' => 'Kode Praktikum harus diisi.',
            'nama_praktikum.required' => 'Nama Praktikum harus diisi.',
            'angkatan.required'      => 'Angkatan harus diisi.',
            'semester.required' => 'Semester harus diisi.',
        ]);

        Praktikum::create([
            'kode_praktikum' => $request->kode_praktikum,
            'nama_praktikum' => $request->nama_praktikum,
            'angkatan' => $request->angkatan,
            'semester' => $request->semester,
        ]);

        return redirect('/admin/praktikum')->with('success', 'Praktikum berhasil ditambahkan!');
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $praktikum = Praktikum::findOrFail($id);

        $request->validate([
            'kode_praktikum' => 'required|string|max:255',
            'nama_praktikum' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
        ], [
            'kode_praktikum.required' => 'Kode Praktikum harus diisi.',
            'nama_praktikum.required' => 'Nama Praktikum harus diisi.',
            'angkatan.required'      => 'Angkatan harus diisi.',
            'semester.required' => 'Semester harus diisi.',
        ]);

        $praktikum->update([
            'kode_praktikum' => $request->kode_praktikum,
            'nama_praktikum' => $request->nama_praktikum,
            'angkatan' => $request->angkatan,
            'semester' => $request->semester,
        ]);

        return redirect('/admin/praktikum')->with('success', 'Praktikum berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $praktikum = Praktikum::findOrFail($id);
        
        $praktikum->delete();
        return redirect('/admin/praktikum');
    }

    function pendaftaranShow()
    {
        return view('mahasiswa/pendaftaran');
    }

    function getMyPraktikum()
    {
        return view('mahasiswa/praktikum');
    }

    function cekStatusPendaftaran()
    {
        return view('dosen/statuspendaftaran');
    }

    function asistensiPraktikum()
    {
           $user = Auth::user();
        
        $praktikumIds = DB::table('pendaftaran_praktikum')
            ->where('id_user', $user->id)
            ->where('role', 'Asisten')
            ->whereIn('status', ['Dikonfirmasi', 'Pending'])
            ->pluck('id_praktikum')
            ->toArray();
        
        $praktikums = Praktikum::whereIn('id', $praktikumIds)
            ->with(['jadwals.laboratorium', 'jadwals.pertemuan'])
            ->get();
        
        foreach ($praktikums as $praktikum) {
            $praktikum->mahasiswa_count = DB::table('pendaftaran_praktikum')
                ->where('id_praktikum', $praktikum->id)
                ->where('role', 'Praktikan')
                ->where('status', 'Dikonfirmasi')
                ->count();
            
            $firstJadwal = $praktikum->jadwals->first();
            if ($firstJadwal) {
                $praktikum->jadwal_hari = $firstJadwal->hari;
                $praktikum->jadwal_jam_mulai = $firstJadwal->jam_mulai;
                $praktikum->jadwal_jam_selesai = $firstJadwal->jam_selesai;
                $praktikum->laboratorium_nama = $firstJadwal->laboratorium?->nama_laboratorium ?? 'Lab N/A';
                $praktikum->laboratorium_lokasi = $firstJadwal->laboratorium?->lokasi ?? '-';
                
                if ($firstJadwal->pertemuan?->first()) {
                    $praktikum->nama_pertemuan = $firstJadwal->pertemuan->first()->nama_pertemuan;
                    $praktikum->deskripsi_pertemuan = $firstJadwal->pertemuan->first()->deskripsi_pertemuan;
                } else {
                    $praktikum->nama_pertemuan = 'Belum ada pertemuan';
                    $praktikum->deskripsi_pertemuan = '-';
                }
            } else {
                $praktikum->jadwal_hari = 'N/A';
                $praktikum->jadwal_jam_mulai = 'N/A';
                $praktikum->jadwal_jam_selesai = 'N/A';
                $praktikum->laboratorium_nama = 'N/A';
                $praktikum->nama_pertemuan = 'Belum ada jadwal';
                $praktikum->deskripsi_pertemuan = '-';
            }
        }
        
        // Get today's schedules for the right sidebar
        $today = Carbon::now()->locale('id')->dayName;
        $dayMapping = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa', 
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ];
        $todayIndo = $dayMapping[$today] ?? $today;
        
        $todayJadwals = Jadwal::with(['praktikum', 'laboratorium', 'pertemuan'])
            ->whereIn('id_praktikum', $praktikumIds)
            ->where('hari', $todayIndo)
            ->orderBy('jam_mulai')
            ->get();
        
        // If no jadwal with Indonesian day, try English
        if ($todayJadwals->isEmpty()) {
            $todayJadwals = Jadwal::with(['praktikum', 'laboratorium', 'pertemuan'])
                ->whereIn('id_praktikum', $praktikumIds)
                ->where('hari', $today)
                ->orderBy('jam_mulai')
                ->get();
        }
        
        // Add mahasiswa count to today's jadwals
        foreach ($todayJadwals as $jadwal) {
            $jadwal->mahasiswa_count = DB::table('pendaftaran_praktikum')
                ->where('id_praktikum', $jadwal->id_praktikum)
                ->where('role', 'Praktikan')
                ->where('status', 'Dikonfirmasi')
                ->count();
        }
        
        // Get unique praktikum names for filter
        $praktikumNames = $praktikums->pluck('nama_praktikum')->unique()->values();
        
        return view('asisten.praktikum_asisten', compact('praktikums', 'todayJadwals', 'praktikumNames'));
    }
}

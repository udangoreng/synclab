<?php

namespace App\Http\Controllers;

use App\Models\Praktikum;
use App\Models\Jadwal;
use App\Models\PendaftaranPraktikum;
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

        // Get user's registrations with jadwal and praktikum details
        $pendaftarans = PendaftaranPraktikum::with(
            'jadwal.praktikum', 
            'jadwal.laboratorium', 
            'jadwal.dosen',
            'jadwal.pertemuan.modul'
            )
            ->where('id_user', $user->id)
            ->get();

        return view('mahasiswa/pendaftaran', compact('praktikums', 'pendaftarans'));
    }

    public function daftarJadwal(Request $request)
{
    $request->validate(['id_jadwal' => 'required|integer|exists:jadwals,id']);
 
    $user   = Auth::user();
    $jadwal = \App\Models\Jadwal::with(['pendaftarans', 'pertemuan'])->findOrFail($request->id_jadwal);
 
    // 1. Pastikan jadwal masih dibuka
    if (!in_array($jadwal->status, ['Dibuka', 'Penuh'])) {
        return response()->json(['success' => false, 'message' => 'Jadwal sudah tidak dapat didaftari.'], 422);
    }
 
    // 2. Cek kuota
    $terisi = $jadwal->pendaftarans->count();
    $maks   = $jadwal->jumlah_max_peserta ?? 0;
    if ($maks > 0 && $terisi >= $maks) {
        return response()->json(['success' => false, 'message' => 'Kuota jadwal sudah penuh.'], 422);
    }
 
    // 3. Cek apakah user sudah terdaftar di pertemuan yang sama
    $idPertemuan = $jadwal->id_pertemuan;
    $sudahDaftar = \App\Models\PendaftaranPraktikum::where('id_user', $user->id)
        ->whereHas('jadwal', fn($q) => $q->where('id_pertemuan', $idPertemuan))
        ->exists();
 
    if ($sudahDaftar) {
        return response()->json([
            'success' => false,
            'message' => 'Anda sudah terdaftar di pertemuan ini. Hanya 1 jadwal per pertemuan yang diizinkan.',
        ], 422);
    }
 
    // 4. Simpan pendaftaran
    \App\Models\PendaftaranPraktikum::create([
        'id_jadwal' => $jadwal->id,
        'id_user'   => $user->id,
        'role'      => 'Praktikan',
    ]);
 
    // 5. Perbarui status jadwal jika sudah penuh
    $terbaru = $jadwal->pendaftarans()->count() + 1;
    if ($maks > 0 && $terbaru >= $maks) {
        $jadwal->update(['status' => 'Penuh']);
    }
 
    return response()->json(['success' => true, 'message' => 'Pendaftaran berhasil!']);
}

     function getMyPraktikum()
    {
        $user = Auth::user();

        // Ambil semua id_jadwal yang sudah didaftarkan user ini
        $idJadwalTerdaftar = PendaftaranPraktikum::where('id_user', $user->id)
            ->pluck('id_jadwal');

        // Dari jadwal tersebut, ambil id_praktikum-nya
        $idPraktikumTerdaftar = Jadwal::whereIn('id', $idJadwalTerdaftar)
            ->pluck('id_praktikum')
            ->unique();

        // ACTIVE: sudah daftar + ada jadwal berstatus Dibuka atau Penuh
        $activePraktikums = Praktikum::whereIn('id', $idPraktikumTerdaftar)
            ->whereHas('jadwals', fn($q) => $q->whereIn('status', ['Dibuka', 'Penuh']))
            ->with([
                'jadwals'                  => fn($q) => $q->whereIn('status', ['Dibuka', 'Penuh']),
                'jadwals.pertemuan.modul',
                'jadwals.laboratorium',
                'jadwals.dosen',
            ])
            ->get();

        // UPCOMING: belum daftar sama sekali + ada jadwal yang masih Dibuka
        $upcomingPraktikums = Praktikum::whereNotIn('id', $idPraktikumTerdaftar)
            ->whereHas('jadwals', fn($q) => $q->where('status', 'Dibuka'))
            ->with([
                'jadwals'                  => fn($q) => $q->where('status', 'Dibuka'),
                'jadwals.pertemuan.modul',
                'jadwals.laboratorium',
                'jadwals.dosen',
                'jadwals.pendaftarans',    // untuk hitung kuota terisi
            ])
            ->get();

        // COMPLETED: sudah daftar + tidak ada jadwal yang masih Dibuka/Penuh (semua Selesai)
        $completedPraktikums = Praktikum::whereIn('id', $idPraktikumTerdaftar)
            ->whereDoesntHave('jadwals', fn($q) => $q->whereIn('status', ['Dibuka', 'Penuh']))
            ->with([
                'jadwals.pertemuan.modul',
                'jadwals.laboratorium',
                'jadwals.dosen',
            ])
            ->get();

        return view('mahasiswa/praktikum', compact(
            'activePraktikums',
            'upcomingPraktikums',
            'completedPraktikums'
        ));
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

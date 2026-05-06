<?php

namespace App\Http\Controllers;

use App\Models\Praktikum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\PendaftaranPraktikum;

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
        })->with('jadwals', 'jadwals.laboratorium')->paginate(15);

        // Add asisten and mahasiswa data to each praktikum
        $praktikums->getCollection()->transform(function ($praktikum) {
            $praktikum->asisten = $praktikum->getAsistens();
            $praktikum->mahasiswa = $praktikum->getPraktikans();
            return $praktikum;
        });

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
    public function edit(Praktikum $praktikum) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
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
    public function destroy(int $id)
    {
        $praktikum = Praktikum::findOrFail($id);

        $praktikum->delete();
        return redirect('/admin/praktikum');
    }

    function pendaftaranShow()
    {
        // Get all available praktikums for registration
        $praktikums = Praktikum::with('jadwals.laboratorium', 'jadwals.dosen')->get();
        $user = Auth::user();

        // Get user's registrations
        $myPraktikums = Praktikum::whereHas('nilais', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })->get();

        return view('mahasiswa/pendaftaran', compact('praktikums', 'myPraktikums'));
    }

    public function daftarJadwal(Request $request)
    {
        $request->validate(['id_jadwal' => 'required|integer|exists:jadwals,id']);

        $user   = Auth::user();
        $jadwal = Jadwal::with(['pendaftarans', 'pertemuan'])->findOrFail($request->id_jadwal);

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
        $sudahDaftar = PendaftaranPraktikum::where('id_user', $user->id)
            ->whereHas('jadwal', fn($q) => $q->where('id_pertemuan', $idPertemuan))
            ->exists();

        if ($sudahDaftar) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah terdaftar di pertemuan ini. Hanya 1 jadwal per pertemuan yang diizinkan.',
            ], 422);
        }

        // 4. Simpan pendaftaran
        PendaftaranPraktikum::create([
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

        // Get praktikums where user has nilai (registered)
        $myPraktikums = Praktikum::whereHas('jadwals.pertemuan.nilais', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })->with([
            'jadwals.laboratorium',
            'jadwals.dosen',
            'jadwals.pertemuans.modul',
            'jadwals.pertemuans.nilais' => function ($q) use ($user) {
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

    function cekStatusPendaftaran()
    {
        return view('dosen/statuspendaftaran');
    }

    public function asistensiPraktikum()
    {
        $user = Auth::user();

        // STEP 1: ambil jadwal ids milik asisten ini
        $jadwalIds = DB::table('pendaftaran_praktikum')
            ->where('id_user', $user->id)
            ->where('role', 'Asisten')
            ->pluck('id_jadwal')
            ->toArray();

        // STEP 2: dari jadwal ids, ambil praktikum ids (unique)
        $praktikumIds = DB::table('jadwals')
            ->whereIn('id', $jadwalIds)
            ->pluck('id_praktikum')
            ->unique()
            ->toArray();

        $praktikums = Praktikum::whereIn('id', $praktikumIds)
            ->with(['jadwals.laboratorium', 'jadwals.pertemuan'])
            ->get();

        foreach ($praktikums as $praktikum) {
            // Ambil jadwal ids milik praktikum ini
            $praktikumJadwalIds = $praktikum->jadwals->pluck('id')->toArray();

            // Hitung mahasiswa via id_jadwal
            $praktikum->mahasiswa_count = DB::table('pendaftaran_praktikum')
                ->whereIn('id_jadwal', $praktikumJadwalIds)
                ->where('role', 'Praktikan')
                ->count();

            $firstJadwal = $praktikum->jadwals->first();
            if ($firstJadwal) {
                $praktikum->jadwal_hari         = $firstJadwal->hari;
                $praktikum->jadwal_jam_mulai    = $firstJadwal->jam_mulai;
                $praktikum->jadwal_jam_selesai  = $firstJadwal->jam_selesai;
                $praktikum->laboratorium_nama   = $firstJadwal->laboratorium?->nama_laboratorium ?? 'Lab N/A';
                $praktikum->laboratorium_lokasi = $firstJadwal->laboratorium?->lokasi ?? '-';

                $firstPertemuan = $firstJadwal->pertemuan?->first();
                $praktikum->nama_pertemuan      = $firstPertemuan?->nama_pertemuan      ?? 'Belum ada pertemuan';
                $praktikum->deskripsi_pertemuan = $firstPertemuan?->deskripsi_pertemuan ?? '-';
            } else {
                $praktikum->jadwal_hari         = 'N/A';
                $praktikum->jadwal_jam_mulai    = 'N/A';
                $praktikum->jadwal_jam_selesai  = 'N/A';
                $praktikum->laboratorium_nama   = 'N/A';
                $praktikum->laboratorium_lokasi = '-';
                $praktikum->nama_pertemuan      = 'Belum ada jadwal';
                $praktikum->deskripsi_pertemuan = '-';
            }
        }

        // Jadwal hari ini
        $today      = Carbon::now()->locale('id')->dayName;
        $dayMapping = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];
        $todayIndo = $dayMapping[$today] ?? $today;

        $todayJadwals = Jadwal::with(['praktikum', 'laboratorium', 'pertemuan'])
            ->whereIn('id_praktikum', $praktikumIds)
            ->where('hari', $todayIndo)
            ->orderBy('jam_mulai')
            ->get();

        if ($todayJadwals->isEmpty()) {
            $todayJadwals = Jadwal::with(['praktikum', 'laboratorium', 'pertemuan'])
                ->whereIn('id_praktikum', $praktikumIds)
                ->where('hari', $today)
                ->orderBy('jam_mulai')
                ->get();
        }

        // Hitung mahasiswa per jadwal hari ini — gunakan id_jadwal langsung
        foreach ($todayJadwals as $jadwal) {
            $jadwal->mahasiswa_count = DB::table('pendaftaran_praktikum')
                ->where('id_jadwal', $jadwal->id)   // ← pakai id jadwal, bukan id_praktikum
                ->where('role', 'Praktikan')
                ->count();
        }

        $praktikumNames = $praktikums->pluck('nama_praktikum')->unique()->values();

        return view('asisten.praktikum_asisten', compact('praktikums', 'todayJadwals', 'praktikumNames'));
    }
}

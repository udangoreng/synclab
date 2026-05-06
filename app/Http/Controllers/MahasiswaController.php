<?php

namespace App\Http\Controllers;

use App\Models\Praktikum;
use App\Models\Nilai;
use App\Models\Presensi;
use App\Models\Modul;
use App\Models\Jadwal;
use App\Models\Pertemuan;
use App\Models\PengumpulanLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function getMyPretest()
    {
        $user = Auth::user();

        // ✅ Fix utama: rantai relasi yang benar Modul -> pertemuan -> praktikum
        $moduls = Modul::with(['pertemuan.praktikum'])
            ->whereHas('pertemuan.praktikum.jadwals.pendaftarans', function ($query) use ($user) {
                $query->where('id_user', $user->id);
            })
            ->get();

        $pretestData = $moduls->map(function ($modul) use ($user) {
            $pertemuan  = $modul->pertemuan;
            $praktikum  = $pertemuan?->praktikum;

            // ✅ Query nyata untuk setiap status
            $statusAbsen = Presensi::where('id_pertemuan', $modul->id_pertemuan)
                ->where('id_user', $user->id)
                ->exists();

            $statusPretest = Nilai::where('id_pertemuan', $modul->id_pertemuan)
                ->where('id_user', $user->id)
                ->whereNotNull('nilai_pretest')
                ->exists();

            $statusLaporan = PengumpulanLaporan::where('id_pertemuan', $modul->id_pertemuan)
                ->where('id_user', $user->id)
                ->exists();

            return [
                'id'            => $modul->id,
                'matkul'        => $praktikum?->nama_praktikum ?? 'Praktikum',
                'modul'         => $modul->judul_modul ?? 'Modul',
                'kode'          => ($praktikum?->kode_praktikum . '-M' . $pertemuan?->pertemuan_ke) ?? 'M1',
                'statusAbsen'   => $statusAbsen,
                'statusPretest' => $statusPretest,
                'statusLaporan' => $statusLaporan,
                'fileLaporan'   => null,
            ];
        })->values();

        $matkulList = $moduls
            ->pluck('pertemuan.praktikum.nama_praktikum')
            ->unique()->filter()->values();

        return view('mahasiswa/pretest', compact('pretestData', 'matkulList'));
    }

    // ─── Endpoint: Presensi / Absen ──────────────────────────────────────────

    public function absenPretest(Request $request, $modulId)
    {
        $user  = Auth::user();
        $modul = Modul::findOrFail($modulId);

        // Cegah duplikat
        $sudahAbsen = Presensi::where('id_pertemuan', $modul->id_pertemuan)
            ->where('id_user', $user->id)
            ->exists();

        if ($sudahAbsen) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan presensi untuk pertemuan ini.'
            ], 409);
        }

        try {
            Presensi::create([
                'id_pertemuan' => $modul->id_pertemuan,
                'id_user'      => $user->id,
                'kehadiran'    => 'Hadir',
                'status'       => 'Pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Presensi berhasil dicatat!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan presensi.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // ─── Endpoint: Mulai Pretest ──────────────────────────────────────────────

    public function startPretest(Request $request, $modulId)
    {
        $user  = Auth::user();
        $modul = Modul::findOrFail($modulId);

        // Cek apakah sudah absen dulu
        $sudahAbsen = Presensi::where('id_pertemuan', $modul->id_pertemuan)
            ->where('id_user', $user->id)
            ->exists();

        if (!$sudahAbsen) {
            return response()->json([
                'success' => false,
                'message' => 'Harap lakukan presensi terlebih dahulu sebelum memulai pretest.'
            ], 422);
        }

        // Cegah mulai pretest dua kali
        $sudahPretest = Nilai::where('id_pertemuan', $modul->id_pertemuan)
            ->where('id_user', $user->id)
            ->whereNotNull('nilai_pretest')
            ->exists();

        if ($sudahPretest) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah mengerjakan pretest ini.'
            ], 409);
        }

        try {
            // Buat record nilai dengan nilai_pretest = 0 (tanda sudah mulai)
            // Sesuaikan logika ini dengan kebutuhan sistem penilaian Anda
            Nilai::firstOrCreate(
                [
                    'id_pertemuan' => $modul->id_pertemuan,
                    'id_user'      => $user->id,
                ],
                [
                    'nilai_pretest' => 0,
                    'status'        => 'Pending',
                ]
            );

            return response()->json([
                'success'   => true,
                'message'   => 'Pretest dimulai! Selamat mengerjakan.',
                // 'redirect' => route('mahasiswa.pretest.soal', $modulId), // opsional
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memulai pretest.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // ─── Endpoint: Upload Laporan ─────────────────────────────────────────────

    public function uploadLaporan(Request $request, $modulId)
    {
        $user  = Auth::user();
        $modul = Modul::findOrFail($modulId);

        $request->validate([
            'file'        => 'required|file|mimes:pdf,doc,docx,zip|max:10240', // max 10MB
            'keterangan'  => 'nullable|string|max:500',
        ]);

        // Cegah upload duplikat
        $sudahUpload = PengumpulanLaporan::where('id_pertemuan', $modul->id_pertemuan)
            ->where('id_user', $user->id)
            ->exists();

        if ($sudahUpload) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan untuk pertemuan ini sudah pernah diupload.'
            ], 409);
        }

        try {
            $path = $request->file('file')->store(
                'laporan/' . $user->id . '/' . $modul->id_pertemuan,
                'public'
            );

            PengumpulanLaporan::create([
                'id_pertemuan' => $modul->id_pertemuan,
                'id_user'      => $user->id,
                'file_path'    => $path,
                'nama_file'    => $request->file('file')->getClientOriginalName(),
                'keterangan'   => $request->input('keterangan'),
                'status'       => 'Pending',
            ]);

            return response()->json([
                'success'   => true,
                'message'   => 'Laporan berhasil diupload!',
                'file_name' => $request->file('file')->getClientOriginalName(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload laporan.',
                'error'   => $e->getMessage()
            ], 500);
        }
}

    function getMyHistory() {
        $user = Auth::user();
        
        // Get user's nilai history with pertemuan
        $nilais = Nilai::where('id_user', $user->id)
            ->with('pertemuan.praktikum')
            ->get();
        
        // Get user's presensi history
        $presensis = Presensi::where('id_user', $user->id)
            ->with('pertemuan.praktikum')
            ->get();
        
        return view('mahasiswa/riwayat', compact('nilais', 'presensis'));
    }

    function getMahasiswa() {
        return view('asisten/mahasiswa_asisten');
    }
    
    function dashboard() {
        $user = Auth::user();
        
        // Get user's nilai with pertemuan (per pertemuan)
        $nilais = Nilai::where('id_user', $user->id)
            ->with('pertemuan.praktikum')
            ->get();
        
        // Get user's presensi with pertemuan
        $presensis = Presensi::where('id_user', $user->id)
            ->with('pertemuan.praktikum')
            ->get();
        
        // Get user's registered praktikums
        $praktikumCount = Praktikum::whereHas('jadwals.pendaftarans', function($query) use ($user) {
            $query->where('id_user', $user->id);
        })->count();
        
        // Calculate average nilai
        $avgNilai = $nilais->avg('nilai_akhir') ?? 0;
        
        // Calculate attendance percentage
        $hadirCount = $presensis->where('kehadiran', 'Hadir')->count();
        $totalPresensi = $presensis->count();
        $attendanceRate = $totalPresensi > 0 ? round(($hadirCount / $totalPresensi) * 100) : 0;
        
        // Get upcoming reminders
        $reminders = [];
        $tomorrow = now()->addDay()->toDateString();
        
        // 1. Praktikum H-1: Jadwal praktikum besok yang user sudah daftar
        $jadwalTomorrow = Jadwal::whereDate('tanggal', $tomorrow)
            ->whereHas('pendaftarans', function($q) use ($user) {
                $q->where('id_user', $user->id);
            })
            ->with('pertemuan.praktikum')
            ->get();
        
        foreach ($jadwalTomorrow as $jadwal) {
            $reminders[] = "Praktikum {$jadwal->pertemuan->praktikum->nama_praktikum} ({$jadwal->jam_mulai} WIB)";
        }
        
        // 2. Pretest H-1: Pertemuan dengan modul (pretest) besok yang user daftar
        $pretestTomorrow = Pertemuan::whereHas('modul')
            ->whereHas('jadwals', function($q) use ($tomorrow) {
                $q->whereDate('tanggal', $tomorrow);
            })
            ->whereHas('jadwals.pendaftarans', function($q) use ($user) {
                $q->where('id_user', $user->id);
            })
            ->with('praktikum', 'jadwals')
            ->get();
        
        foreach ($pretestTomorrow as $pertemuan) {
            $jadwal = $pertemuan->jadwals->first();
            $reminders[] = "{$pertemuan->praktikum->nama_praktikum} - Pretest (Besok {$jadwal->jam_mulai} WIB)";
        }
        
        // 3. Laporan belum submit: Pertemuan yang user daftar tapi belum submit laporan
        $unsubmittedLaporan = Pertemuan::whereHas('jadwals.pendaftarans', function($q) use ($user) {
                $q->where('id_user', $user->id);
            })
            ->whereDoesntHave('pengumpulanLaporans', function($q) use ($user) {
                $q->where('id_user', $user->id);
            })
            ->with('praktikum', 'jadwals')
            ->get();
        
        foreach ($unsubmittedLaporan as $pertemuan) {
            $jadwal = $pertemuan->jadwals->first();
            $deadline = $jadwal?->tanggal ? date('d M Y', strtotime($jadwal->tanggal)) : '-';
            $reminders[] = "Laporan {$pertemuan->praktikum->nama_praktikum} (Deadline {$deadline})";
        }
        
        // Get all nilai per pertemuan for display
        $nilaiPerPertemuan = $nilais->map(function($nilai) {
            return [
                'praktikum' => $nilai->pertemuan?->praktikum?->nama_praktikum ?? '-',
                'pertemuan' => $nilai->pertemuan?->nama_pertemuan ?? '-',
                'modul' => $nilai->pertemuan?->modul?->judul_modul ?? '-',
                'nilai_pretest' => $nilai->nilai_pretest,
                'nilai_laporan' => $nilai->nilai_laporan,
                'nilai_total' => $nilai->nilai_total,
                'nilai_akhir' => $nilai->nilai_akhir,
                'status' => $nilai->status,
            ];
        });
        
        return view('mahasiswa/dashboard', compact(
            'user', 
            'praktikumCount', 
            'nilais', 
            'presensis', 
            'avgNilai', 
            'attendanceRate',
            'reminders',
            'nilaiPerPertemuan'
        ));
    }
}

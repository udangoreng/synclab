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

        $moduls = Modul::with(['pertemuan.praktikum'])
            ->whereHas('pertemuan.praktikum.jadwals.pendaftarans', function ($query) use ($user) {
                $query->where('id_user', $user->id);
            })
            ->get();

        $pretestData = $moduls->map(function ($modul) use ($user) {
            $pertemuan  = $modul->pertemuan;
            $praktikum  = $pertemuan?->praktikum;

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

        $sudahAbsen = Presensi::where('id_pertemuan', $modul->id_pertemuan)
            ->where('id_user', $user->id)
            ->exists();

        if (!$sudahAbsen) {
            return response()->json([
                'success' => false,
                'message' => 'Harap lakukan presensi terlebih dahulu sebelum memulai pretest.'
            ], 422);
        }

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
                'success' => true,
                'message' => 'Pretest dimulai! Selamat mengerjakan.',
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
            'file'       => 'required|file|mimes:pdf,doc,docx,zip|max:10240',
            'keterangan' => 'nullable|string|max:500',
        ]);

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

    public function getMyHistory()
    {
        $user = Auth::user();

        $nilais = Nilai::where('id_user', $user->id)
            ->with('pertemuan.praktikum')
            ->get();

        $presensis = Presensi::where('id_user', $user->id)
            ->with('pertemuan.praktikum')
            ->get();

        return view('mahasiswa/riwayat', compact('nilais', 'presensis'));
    }

    public function getMahasiswa()
    {
        return view('asisten/mahasiswa_asisten');
    }

    public function dashboard()
{
    $user = Auth::user();
 
    // ── Nilai & Presensi ──────────────────────────────────────
    // PENTING: tambahkan 'pertemuan.jadwal' agar blade bisa akses
    //          dosen, jam_mulai, ruangan dari jadwal.
    $nilais = Nilai::where('id_user', $user->id)
        ->with('pertemuan.praktikum', 'pertemuan.modul', 'pertemuan.jadwal')
        ->get();
 
    $presensis = Presensi::where('id_user', $user->id)
        ->with('pertemuan.praktikum')
        ->get();
 
    // ── Jumlah praktikum terdaftar ────────────────────────────
    $praktikumCount = Praktikum::whereHas('jadwals.pendaftarans', function ($query) use ($user) {
        $query->where('id_user', $user->id);
    })->count();
 
    // ── Rata-rata nilai ───────────────────────────────────────
    $avgNilai = $nilais->avg('nilai_akhir') ?? 0;
 
    // ── Persentase kehadiran ──────────────────────────────────
    $hadirCount     = $presensis->where('kehadiran', 'Hadir')->count();
    $totalPresensi  = $presensis->count();
    $attendanceRate = $totalPresensi > 0
        ? round(($hadirCount / $totalPresensi) * 100)
        : 0;
 
    // ── Nama hari Indonesia ───────────────────────────────────
    $hariMap = [
        0 => 'Minggu',
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu',
    ];
 
    $hariIni   = $hariMap[now()->dayOfWeek];
    $hariBesok = $hariMap[now()->copy()->addDay()->dayOfWeek]; // copy() cegah mutasi
 
    // ── Jadwal HARI INI (baru) ────────────────────────────────
    // Dipakai di blade untuk section "Hari Ini" pada Reminder.
    $jadwalHariIniData = Jadwal::where('hari', $hariIni)
        ->whereHas('pendaftarans', function ($q) use ($user) {
            $q->where('id_user', $user->id);
        })
        ->with('praktikum')
        ->get();
 
    $jadwalHariIni = $jadwalHariIniData->map(function ($jadwal) {
        return [
            'praktikum' => $jadwal->praktikum->nama_praktikum ?? 'Praktikum',
            'jam'       => $jadwal->jam_mulai ?? '-',
            'ruangan'   => $jadwal->laboratorium?->nama_laboratorium   ?? '-',
            'hari'      => $jadwal->hari       ?? '-',
        ];
    })->values()->toArray();
 
    // ── Reminders (associative array) ────────────────────────
    $reminders = [];
 
    // Reminder 1: Jadwal praktikum besok
    $jadwalBesok = Jadwal::where('hari', $hariBesok)
        ->whereHas('pendaftarans', function ($q) use ($user) {
            $q->where('id_user', $user->id);
        })
        ->with('praktikum')
        ->get();
 
    foreach ($jadwalBesok as $jadwal) {
        $reminders[] = [
            'praktikum' => $jadwal->praktikum->nama_praktikum ?? 'Praktikum',
            'pertemuan' => 'Besok - ' . ($jadwal->hari ?? '-'),
            'modul'     => ($jadwal->jam_mulai ?? '-') . ' WIB',
            'nilai'     => '-',
            'status'    => 'Jadwal Besok',
        ];
    }
 
    // Reminder 2: Pertemuan dengan pretest besok
    $pretestBesok = Pertemuan::whereHas('modul')
        ->whereHas('jadwal', function ($q) use ($hariBesok) {
            $q->where('hari', $hariBesok);
        })
        ->whereHas('jadwal.pendaftarans', function ($q) use ($user) {
            $q->where('id_user', $user->id);
        })
        ->with('praktikum', 'jadwal')
        ->get();
 
    foreach ($pretestBesok as $pertemuan) {
        $jadwal = $pertemuan->jadwal;
        $reminders[] = [
            'praktikum' => $pertemuan->praktikum->nama_praktikum ?? '-',
            'pertemuan' => $pertemuan->nama_pertemuan ?? '-',
            'modul'     => ($jadwal?->jam_mulai ?? '-') . ' WIB',
            'nilai'     => '-',
            'status'    => 'Pretest Besok',
        ];
    }
 
    // ── Nilai per pertemuan ───────────────────────────────────
    $nilaiPerPertemuan = $nilais->map(function ($nilai) {
        return [
            'praktikum'     => $nilai->pertemuan?->praktikum?->nama_praktikum ?? '-',
            'pertemuan'     => $nilai->pertemuan?->nama_pertemuan ?? '-',
            'modul'         => $nilai->pertemuan?->modul?->judul_modul ?? '-',
            'nilai_pretest' => $nilai->nilai_pretest,
            'nilai_laporan' => $nilai->nilai_laporan,
            'nilai_total'   => $nilai->nilai_total,
            'nilai_akhir'   => $nilai->nilai_akhir,
            'status'        => $nilai->status,
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
        'nilaiPerPertemuan',
        'jadwalHariIni'  
    ));
}
}
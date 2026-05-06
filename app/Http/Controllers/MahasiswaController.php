<?php

namespace App\Http\Controllers;

use App\Models\Praktikum;
use App\Models\Nilai;
use App\Models\Presensi;
use App\Models\Modul;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    function getMyPretest() {
        $user = Auth::user();
        
        // Get user's registered praktikums
        $myPraktikums = Praktikum::whereHas('jadwals.pertemuans.nilais', function($query) use ($user) {
            $query->where('id_user', $user->id);
        })->with('moduls')->get();
        
        // Get all available modul
        $moduls = Modul::with('praktikum')->get();
        
        return view('mahasiswa/pretest', compact('myPraktikums', 'moduls'));
    }

    function getMyHistory() {
        $user = Auth::user();
        
        // Get user's nilai history with pertemuan
        $nilais = Nilai::where('id_user', $user->id)
            ->with('pertemuan.jadwal.praktikum')
            ->get();
        
        // Get user's presensi history
        $presensis = Presensi::where('id_user', $user->id)
            ->with('pertemuan.jadwal.praktikum')
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
            ->with('pertemuan.jadwal.praktikum')
            ->get();
        
        // Get user's presensi with pertemuan
        $presensis = Presensi::where('id_user', $user->id)
            ->with('pertemuan.jadwal.praktikum')
            ->get();
        
        // Get user's registered praktikums
        $praktikumCount = Praktikum::whereHas('jadwals.pertemuans.nilais', function($query) use ($user) {
            $query->where('id_user', $user->id);
        })->count();
        
        // Calculate average nilai
        $avgNilai = $nilais->avg('nilai_akhir') ?? 0;
        
        // Calculate attendance percentage
        $hadirCount = $presensis->where('kehadiran', 'Hadir')->count();
        $totalPresensi = $presensis->count();
        $attendanceRate = $totalPresensi > 0 ? round(($hadirCount / $totalPresensi) * 100) : 0;
        
        // Get upcoming reminders (pertemuan yang akan datang)
        $reminders = [];
        foreach ($nilais as $nilai) {
            if ($nilai->pertemuan && $nilai->pertemuan->jadwal) {
                $reminders[] = [
                    'praktikum' => $nilai->pertemuan->jadwal->praktikum->nama_praktikum ?? 'Praktikum',
                    'pertemuan' => $nilai->pertemuan->nama_pertemuan,
                    'modul' => $nilai->pertemuan->modul->judul_modul ?? '-',
                    'nilai' => $nilai->nilai_akhir,
                    'status' => $nilai->status,
                ];
            }
        }
        
        // Get all nilai per pertemuan for display
        $nilaiPerPertemuan = $nilais->map(function($nilai) {
            return [
                'praktikum' => $nilai->pertemuan?->jadwal?->praktikum?->nama_praktikum ?? '-',
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

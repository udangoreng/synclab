<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Praktikum;
use App\Models\Pertemuan;
use App\Models\User;
use App\Models\Laboratorium;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get data
        $praktikums = Praktikum::all()->keyBy('kode_praktikum');
        $pertemuans = Pertemuan::all();
        $dosens = User::where('role', 'Dosen')->get();
        $laboratoriums = Laboratorium::all();

        if ($praktikums->isEmpty() || $pertemuans->isEmpty() || $dosens->isEmpty() || $laboratoriums->isEmpty()) {
            return;
        }

        // Helper function untuk mendapatkan pertemuan tertentu dari praktikum
        $getPertemuan = function($kodePraktikum, $pertemuanKe) use ($pertemuans) {
            return $pertemuans->firstWhere(function($item) use ($kodePraktikum, $pertemuanKe) {
                return $item->kode_praktikum === $kodePraktikum && $item->pertemuan_ke === $pertemuanKe;
            });
        };

        $jadwals = [];

        // --- Pemrograman Dasar (PD2401) ---
        // Pertemuan 1: Senin 13:00-15:00
        $pertemuan = $getPertemuan('PD2401', 1);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'PD2401',
                'id_dosen' => $dosens[0]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[0]->id,
                'hari' => 'Senin',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:00:00',
                'jumlah_max_peserta' => 30,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 2: Senin 15:00-17:00
        $pertemuan = $getPertemuan('PD2401', 2);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'PD2401',
                'id_dosen' => $dosens[0]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[0]->id,
                'hari' => 'Senin',
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '17:00:00',
                'jumlah_max_peserta' => 30,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 3: Rabu 13:00-15:00
        $pertemuan = $getPertemuan('PD2401', 3);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'PD2401',
                'id_dosen' => $dosens[0]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[1]->id,
                'hari' => 'Rabu',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:00:00',
                'jumlah_max_peserta' => 30,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 4: Rabu 15:00-17:00
        $pertemuan = $getPertemuan('PD2401', 4);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'PD2401',
                'id_dosen' => $dosens[0]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[1]->id,
                'hari' => 'Rabu',
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '17:00:00',
                'jumlah_max_peserta' => 30,
                'status' => 'Dibuka',
            ];
        }

        // --- Struktur Data (SD2402) ---
        // Pertemuan 1: Selasa 10:00-12:00
        $pertemuan = $getPertemuan('SD2402', 1);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'SD2402',
                'id_dosen' => $dosens[1]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[0]->id,
                'hari' => 'Selasa',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:00:00',
                'jumlah_max_peserta' => 25,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 2: Selasa 13:00-15:00
        $pertemuan = $getPertemuan('SD2402', 2);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'SD2402',
                'id_dosen' => $dosens[1]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[0]->id,
                'hari' => 'Selasa',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:00:00',
                'jumlah_max_peserta' => 25,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 3: Kamis 10:00-12:00
        $pertemuan = $getPertemuan('SD2402', 3);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'SD2402',
                'id_dosen' => $dosens[1]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[1]->id,
                'hari' => 'Kamis',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:00:00',
                'jumlah_max_peserta' => 25,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 4: Kamis 13:00-15:00
        $pertemuan = $getPertemuan('SD2402', 4);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'SD2402',
                'id_dosen' => $dosens[1]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[1]->id,
                'hari' => 'Kamis',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:00:00',
                'jumlah_max_peserta' => 25,
                'status' => 'Dibuka',
            ];
        }

        // --- Basis Data (BD2403) ---
        // Pertemuan 1: Senin 10:00-12:00
        $pertemuan = $getPertemuan('BD2403', 1);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'BD2403',
                'id_dosen' => $dosens[2]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[0]->id,
                'hari' => 'Senin',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:00:00',
                'jumlah_max_peserta' => 25,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 2: Senin 08:00-10:00
        $pertemuan = $getPertemuan('BD2403', 2);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'BD2403',
                'id_dosen' => $dosens[2]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[0]->id,
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'jumlah_max_peserta' => 25,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 3: Jumat 10:00-12:00
        $pertemuan = $getPertemuan('BD2403', 3);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'BD2403',
                'id_dosen' => $dosens[2]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[1]->id,
                'hari' => 'Jumat',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:00:00',
                'jumlah_max_peserta' => 25,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 4: Jumat 13:00-15:00
        $pertemuan = $getPertemuan('BD2403', 4);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'BD2403',
                'id_dosen' => $dosens[2]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[1]->id,
                'hari' => 'Jumat',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:00:00',
                'jumlah_max_peserta' => 25,
                'status' => 'Dibuka',
            ];
        }

        // --- Jaringan Komputer (JARKOM2404) ---
        // Pertemuan 1: Kamis 08:00-10:00
        $pertemuan = $getPertemuan('JARKOM2404', 1);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'JARKOM2404',
                'id_dosen' => $dosens[3]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[2]->id,
                'hari' => 'Kamis',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'jumlah_max_peserta' => 20,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 2: Kamis 15:00-17:00
        $pertemuan = $getPertemuan('JARKOM2404', 2);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'JARKOM2404',
                'id_dosen' => $dosens[3]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[2]->id,
                'hari' => 'Kamis',
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '17:00:00',
                'jumlah_max_peserta' => 20,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 3: Jumat 08:00-10:00
        $pertemuan = $getPertemuan('JARKOM2404', 3);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'JARKOM2404',
                'id_dosen' => $dosens[3]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[2]->id,
                'hari' => 'Jumat',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'jumlah_max_peserta' => 20,
                'status' => 'Dibuka',
            ];
        }

        // Pertemuan 4: Jumat 15:00-17:00
        $pertemuan = $getPertemuan('JARKOM2404', 4);
        if ($pertemuan) {
            $jadwals[] = [
                'kode_praktikum' => 'JARKOM2404',
                'id_dosen' => $dosens[3]->id,
                'id_pertemuan' => $pertemuan->id,
                'id_laboratorium' => $laboratoriums[2]->id,
                'hari' => 'Jumat',
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '17:00:00',
                'jumlah_max_peserta' => 20,
                'status' => 'Dibuka',
            ];
        }

        // Insert all jadwals
        foreach ($jadwals as $jadwal) {
            Jadwal::create($jadwal);
        }
    }
}

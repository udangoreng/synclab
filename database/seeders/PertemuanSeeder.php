<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Pertemuan;
use Illuminate\Database\Seeder;

class PertemuanSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = Jadwal::with('praktikum')->get();

        if ($jadwals->isEmpty()) {
            return;
        }

        foreach ($jadwals as $jadwal) {
            for ($ke = 1; $ke <= 6; $ke++) {
                Pertemuan::create([
                    'id_praktikum' => $jadwal->id_praktikum,
                    'id_jadwal' => $jadwal->id,
                    'nama_pertemuan' => "Pertemuan {$ke}: " . $this->getName($jadwal->praktikum->kode_praktikum, $ke),
                    'pertemuan_ke' => $ke,
                    'deskripsi_pertemuan' => $this->getDesc($jadwal->praktikum->kode_praktikum, $ke),
                ]);
            }
        }
    }

    private function getName($kode, $ke)
    {
        $data = $this->getData();

        return $data[$kode][$ke]['nama'] ?? "Pertemuan {$ke}";
    }

    private function getDesc($kode, $ke)
    {
        $data = $this->getData();

        return $data[$kode][$ke]['desc'] ?? "Deskripsi pertemuan {$ke}";
    }

    private function getData(): array
    {
        return [
            'PD2401' => [
                1 => ['nama' => 'Instalasi & Sintaks Dasar', 'desc' => 'Setup environment dan dasar sintaks C++'],
                2 => ['nama' => 'Percabangan & Perulangan', 'desc' => 'If, switch, loop (for, while)'],
                3 => ['nama' => 'Fungsi', 'desc' => 'Pembuatan fungsi dan modularisasi'],
                4 => ['nama' => 'Array & String', 'desc' => 'Array 1D/2D dan manipulasi string'],
                5 => ['nama' => 'Pointer', 'desc' => 'Pointer dan manajemen memori'],
                6 => ['nama' => 'File I/O', 'desc' => 'Baca tulis file dan error handling'],
            ],

            'SD2402' => [
                1 => ['nama' => 'Array & Linked List', 'desc' => 'Struktur data linear'],
                2 => ['nama' => 'Stack & Queue', 'desc' => 'Implementasi LIFO dan FIFO'],
                3 => ['nama' => 'Tree', 'desc' => 'Binary tree dan traversal'],
                4 => ['nama' => 'Graph', 'desc' => 'Representasi graph dan BFS/DFS'],
                5 => ['nama' => 'Sorting', 'desc' => 'Algoritma sorting'],
                6 => ['nama' => 'Hashing', 'desc' => 'Hash table dan collision'],
            ],

            'BD2403' => [
                1 => ['nama' => 'Pengenalan DB', 'desc' => 'Konsep dasar basis data'],
                2 => ['nama' => 'ERD', 'desc' => 'Perancangan ERD'],
                3 => ['nama' => 'Relasi', 'desc' => 'Relasi antar tabel'],
                4 => ['nama' => 'SQL Dasar', 'desc' => 'SELECT, INSERT, UPDATE'],
                5 => ['nama' => 'Join', 'desc' => 'Inner, left, right join'],
                6 => ['nama' => 'Normalisasi', 'desc' => '1NF, 2NF, 3NF'],
            ],

            'JARKOM2404' => [
                1 => ['nama' => 'Dasar Jaringan', 'desc' => 'Konsep jaringan komputer'],
                2 => ['nama' => 'OSI Layer', 'desc' => '7 layer OSI'],
                3 => ['nama' => 'IP Addressing', 'desc' => 'IPv4 dan subnetting'],
                4 => ['nama' => 'Routing', 'desc' => 'Static & dynamic routing'],
                5 => ['nama' => 'Switching', 'desc' => 'VLAN dan switching'],
                6 => ['nama' => 'Troubleshooting', 'desc' => 'Analisis jaringan'],
            ],

            'PCD2406' => [
                1 => ['nama' => 'Intro Citra', 'desc' => 'Dasar citra digital'],
                2 => ['nama' => 'Histogram', 'desc' => 'Histogram citra'],
                3 => ['nama' => 'Filtering', 'desc' => 'Filter spasial'],
                4 => ['nama' => 'Transformasi', 'desc' => 'Transformasi citra'],
                5 => ['nama' => 'Segmentasi', 'desc' => 'Segmentasi objek'],
                6 => ['nama' => 'Deteksi Tepi', 'desc' => 'Edge detection'],
            ],

            'RPL2408' => [
                1 => ['nama' => 'Intro RPL', 'desc' => 'Konsep rekayasa perangkat lunak'],
                2 => ['nama' => 'SDLC', 'desc' => 'Model pengembangan'],
                3 => ['nama' => 'Requirement', 'desc' => 'Analisis kebutuhan'],
                4 => ['nama' => 'Design', 'desc' => 'UML dan desain sistem'],
                5 => ['nama' => 'Implementasi', 'desc' => 'Coding & versioning'],
                6 => ['nama' => 'Testing', 'desc' => 'Unit & integration testing'],
            ],
        ];
    }
}
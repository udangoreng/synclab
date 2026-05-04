<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\Pertemuan;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pertemuans = Pertemuan::all();

        if ($pertemuans->isEmpty()) {
            return;
        }

        // Helper untuk mencari pertemuan
        $getPertemuan = function($kodePraktikum, $pertemuanKe) use ($pertemuans) {
            return $pertemuans->firstWhere(function($item) use ($kodePraktikum, $pertemuanKe) {
                return $item->kode_praktikum === $kodePraktikum && $item->pertemuan_ke === $pertemuanKe;
            });
        };

        $laporans = [
            // Pemrograman Dasar
            [
                'id_pertemuan' => $getPertemuan('PD2401', 1)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 1: Instalasi & Sintaks Dasar',
                'open_date' => date('Y-m-d', strtotime('+1 day')),
                'close_date' => date('Y-m-d', strtotime('+8 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang instalasi compiler C++ dan pembuatan program dasar dengan sintaks.',
            ],
            [
                'id_pertemuan' => $getPertemuan('PD2401', 2)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 2: Percabangan & Perulangan',
                'open_date' => date('Y-m-d', strtotime('+8 days')),
                'close_date' => date('Y-m-d', strtotime('+15 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang implementasi if-else, switch-case, dan berbagai jenis loop.',
            ],
            [
                'id_pertemuan' => $getPertemuan('PD2401', 3)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 3: Fungsi & Modularitas',
                'open_date' => date('Y-m-d', strtotime('+15 days')),
                'close_date' => date('Y-m-d', strtotime('+22 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang pembuatan dan penggunaan fungsi untuk program modular.',
            ],
            [
                'id_pertemuan' => $getPertemuan('PD2401', 4)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 4: Array & String',
                'open_date' => date('Y-m-d', strtotime('+22 days')),
                'close_date' => date('Y-m-d', strtotime('+29 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang penggunaan array 1D, 2D, dan manipulasi string dalam C++.',
            ],

            // Struktur Data
            [
                'id_pertemuan' => $getPertemuan('SD2402', 1)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 1: Array & Linked List',
                'open_date' => date('Y-m-d', strtotime('+1 day')),
                'close_date' => date('Y-m-d', strtotime('+8 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang implementasi single linked list dengan berbagai operasi.',
            ],
            [
                'id_pertemuan' => $getPertemuan('SD2402', 2)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 2: Stack & Queue',
                'open_date' => date('Y-m-d', strtotime('+8 days')),
                'close_date' => date('Y-m-d', strtotime('+15 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang implementasi stack (LIFO) dan queue (FIFO).',
            ],
            [
                'id_pertemuan' => $getPertemuan('SD2402', 3)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 3: Tree & Binary Search Tree',
                'open_date' => date('Y-m-d', strtotime('+15 days')),
                'close_date' => date('Y-m-d', strtotime('+22 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang implementasi binary search tree dan tree traversal.',
            ],
            [
                'id_pertemuan' => $getPertemuan('SD2402', 4)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 4: Graph & Searching',
                'open_date' => date('Y-m-d', strtotime('+22 days')),
                'close_date' => date('Y-m-d', strtotime('+29 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang implementasi graph dan algoritma BFS/DFS.',
            ],

            // Basis Data
            [
                'id_pertemuan' => $getPertemuan('BD2403', 1)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 1: SQL Basic & Query',
                'open_date' => date('Y-m-d', strtotime('+1 day')),
                'close_date' => date('Y-m-d', strtotime('+8 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang penggunaan SQL SELECT, WHERE, ORDER BY, dan GROUP BY.',
            ],
            [
                'id_pertemuan' => $getPertemuan('BD2403', 2)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 2: Join & Subquery',
                'open_date' => date('Y-m-d', strtotime('+8 days')),
                'close_date' => date('Y-m-d', strtotime('+15 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang penggunaan berbagai jenis JOIN dan subquery.',
            ],
            [
                'id_pertemuan' => $getPertemuan('BD2403', 3)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 3: DML & DDL',
                'open_date' => date('Y-m-d', strtotime('+15 days')),
                'close_date' => date('Y-m-d', strtotime('+22 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang INSERT, UPDATE, DELETE, dan manipulasi struktur tabel.',
            ],
            [
                'id_pertemuan' => $getPertemuan('BD2403', 4)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 4: Indexing & Performance',
                'open_date' => date('Y-m-d', strtotime('+22 days')),
                'close_date' => date('Y-m-d', strtotime('+29 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang penggunaan index dan optimasi query.',
            ],

            // Jaringan Komputer
            [
                'id_pertemuan' => $getPertemuan('JARKOM2404', 1)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 1: Konfigurasi Cisco Packet Tracer',
                'open_date' => date('Y-m-d', strtotime('+1 day')),
                'close_date' => date('Y-m-d', strtotime('+8 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang penggunaan Cisco Packet Tracer dan pembuatan topologi.',
            ],
            [
                'id_pertemuan' => $getPertemuan('JARKOM2404', 2)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 2: Konfigurasi IP Address',
                'open_date' => date('Y-m-d', strtotime('+8 days')),
                'close_date' => date('Y-m-d', strtotime('+15 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang konfigurasi IP address dan subnet mask.',
            ],
            [
                'id_pertemuan' => $getPertemuan('JARKOM2404', 3)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 3: Routing & OSPF',
                'open_date' => date('Y-m-d', strtotime('+15 days')),
                'close_date' => date('Y-m-d', strtotime('+22 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang konfigurasi routing dinamis menggunakan OSPF.',
            ],
            [
                'id_pertemuan' => $getPertemuan('JARKOM2404', 4)?->id,
                'judul_laporan' => 'Laporan Praktikum Pertemuan 4: ACL & Security',
                'open_date' => date('Y-m-d', strtotime('+22 days')),
                'close_date' => date('Y-m-d', strtotime('+29 days')),
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'deskripsi' => 'Laporan hasil praktikum tentang konfigurasi ACL untuk keamanan jaringan.',
            ],
        ];

        foreach ($laporans as $laporan) {
            if ($laporan['id_pertemuan']) {
                Laporan::create($laporan);
            }
        }
    }
}

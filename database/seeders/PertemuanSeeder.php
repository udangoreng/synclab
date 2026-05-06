<?php

namespace Database\Seeders;

use App\Models\Pertemuan;
use App\Models\Praktikum;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class PertemuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan data praktikum sudah ada
        if (Praktikum::count() == 0) {
            $this->command->info('Data Praktikum kosong, silakan jalankan PraktikumSeeder terlebih dahulu.');
            return;
        }

        $pertemuans = [
            // --- Pemrograman Dasar (PD2401) ---
            [
                'kode_praktikum' => 'PD2401',
                'nama_pertemuan' => 'Pertemuan 1: Instalasi & Sintaks Dasar',
                'pertemuan_ke' => 1,
                'deskripsi_pertemuan' => 'Pengenalan lingkungan pengembangan dan dasar-dasar sintaks pemrograman dalam bahasa C++.',
            ],
            [
                'kode_praktikum' => 'PD2401',
                'nama_pertemuan' => 'Pertemuan 2: Percabangan & Perulangan',
                'pertemuan_ke' => 2,
                'deskripsi_pertemuan' => 'Mempelajari logika kontrol program menggunakan If-Else, Switch-Case, dan Loops.',
            ],
            [
                'kode_praktikum' => 'PD2401',
                'nama_pertemuan' => 'Pertemuan 3: Fungsi & Modularitas',
                'pertemuan_ke' => 3,
                'deskripsi_pertemuan' => 'Pembuatan dan penggunaan fungsi untuk membuat program yang lebih modular.',
            ],
            [
                'kode_praktikum' => 'PD2401',
                'nama_pertemuan' => 'Pertemuan 4: Array & String',
                'pertemuan_ke' => 4,
                'deskripsi_pertemuan' => 'Implementasi array 1D dan 2D, serta manipulasi string dalam C++.',
            ],

            // --- Struktur Data (SD2402) ---
            [
                'kode_praktikum' => 'SD2402',
                'nama_pertemuan' => 'Pertemuan 1: Array & Linked List',
                'pertemuan_ke' => 1,
                'deskripsi_pertemuan' => 'Implementasi array dan single linked list dalam struktur data.',
            ],
            [
                'kode_praktikum' => 'SD2402',
                'nama_pertemuan' => 'Pertemuan 2: Stack & Queue',
                'pertemuan_ke' => 2,
                'deskripsi_pertemuan' => 'Implementasi stack (LIFO) dan queue (FIFO) dengan berbagai operasi.',
            ],
            [
                'kode_praktikum' => 'SD2402',
                'nama_pertemuan' => 'Pertemuan 3: Tree & Binary Search Tree',
                'pertemuan_ke' => 3,
                'deskripsi_pertemuan' => 'Pemahaman dan implementasi tree serta binary search tree.',
            ],
            [
                'kode_praktikum' => 'SD2402',
                'nama_pertemuan' => 'Pertemuan 4: Graph & Searching',
                'pertemuan_ke' => 4,
                'deskripsi_pertemuan' => 'Implementasi graph dan algoritma searching seperti BFS dan DFS.',
            ],

            // --- Basis Data (BD2403) ---
            [
                'kode_praktikum' => 'BD2403',
                'nama_pertemuan' => 'Pertemuan 1: SQL Basic & Query',
                'pertemuan_ke' => 1,
                'deskripsi_pertemuan' => 'Dasar-dasar SQL dan query SELECT dari satu atau multiple table.',
            ],
            [
                'kode_praktikum' => 'BD2403',
                'nama_pertemuan' => 'Pertemuan 2: Join & Subquery',
                'pertemuan_ke' => 2,
                'deskripsi_pertemuan' => 'Penggunaan JOIN (INNER, LEFT, RIGHT) dan subquery dalam database.',
            ],
            [
                'kode_praktikum' => 'BD2403',
                'nama_pertemuan' => 'Pertemuan 3: DML & DDL',
                'pertemuan_ke' => 3,
                'deskripsi_pertemuan' => 'Manipulasi data dengan INSERT, UPDATE, DELETE dan pembuatan struktur tabel.',
            ],
            [
                'kode_praktikum' => 'BD2403',
                'nama_pertemuan' => 'Pertemuan 4: Indexing & Performance',
                'pertemuan_ke' => 4,
                'deskripsi_pertemuan' => 'Penggunaan index untuk optimasi query dan performa database.',
            ],

            // --- Jaringan Komputer (JARKOM2404) ---
            [
                'kode_praktikum' => 'JARKOM2404',
                'nama_pertemuan' => 'Pertemuan 1: Konfigurasi Cisco Packet Tracer',
                'pertemuan_ke' => 1,
                'deskripsi_pertemuan' => 'Pengenalan Cisco Packet Tracer dan desain topologi jaringan dasar.',
            ],
            [
                'kode_praktikum' => 'JARKOM2404',
                'nama_pertemuan' => 'Pertemuan 2: Konfigurasi IP Address',
                'pertemuan_ke' => 2,
                'deskripsi_pertemuan' => 'Konfigurasi IP address, subnet mask, dan gateway pada perangkat jaringan.',
            ],
            [
                'kode_praktikum' => 'JARKOM2404',
                'nama_pertemuan' => 'Pertemuan 3: Routing & OSPF',
                'pertemuan_ke' => 3,
                'deskripsi_pertemuan' => 'Konfigurasi routing dinamis menggunakan protokol OSPF.',
            ],
            [
                'kode_praktikum' => 'JARKOM2404',
                'nama_pertemuan' => 'Pertemuan 4: ACL & Security',
                'pertemuan_ke' => 4,
                'deskripsi_pertemuan' => 'Konfigurasi ACL (Access Control List) untuk keamanan jaringan.',
            ],

            // --- Sistem Operasi (SO2405) ---
            [
                'kode_praktikum' => 'SO2405',
                'nama_pertemuan' => 'Pertemuan 1: Process Management',
                'pertemuan_ke' => 1,
                'deskripsi_pertemuan' => 'Pemahaman proses, thread, dan manajemen proses dalam sistem operasi.',
            ],
            [
                'kode_praktikum' => 'SO2405',
                'nama_pertemuan' => 'Pertemuan 2: Memory Management',
                'pertemuan_ke' => 2,
                'deskripsi_pertemuan' => 'Manajemen memori, virtual memory, dan paging dalam sistem operasi.',
            ],
            [
                'kode_praktikum' => 'SO2405',
                'nama_pertemuan' => 'Pertemuan 3: File System',
                'pertemuan_ke' => 3,
                'deskripsi_pertemuan' => 'Struktur file system dan manajemen file dalam sistem operasi.',
            ],
            [
                'kode_praktikum' => 'SO2405',
                'nama_pertemuan' => 'Pertemuan 4: I/O & Device Management',
                'pertemuan_ke' => 4,
                'deskripsi_pertemuan' => 'Manajemen input/output dan device driver dalam sistem operasi.',
            ],

            // --- Pengolahan Citra Digital (PCD2406) ---
            [
                'kode_praktikum' => 'PCD2406',
                'nama_pertemuan' => 'Pertemuan 1: Image Fundamentals',
                'pertemuan_ke' => 1,
                'deskripsi_pertemuan' => 'Dasar citra digital, sampling, quantization, dan representasi warna.',
            ],
            [
                'kode_praktikum' => 'PCD2406',
                'nama_pertemuan' => 'Pertemuan 2: Image Enhancement',
                'pertemuan_ke' => 2,
                'deskripsi_pertemuan' => 'Teknik perbaikan citra seperti histogram equalization dan filtering.',
            ],
            [
                'kode_praktikum' => 'PCD2406',
                'nama_pertemuan' => 'Pertemuan 3: Image Restoration',
                'pertemuan_ke' => 3,
                'deskripsi_pertemuan' => 'Restorasi citra dari noise dan blur menggunakan filter adaptif.',
            ],
            [
                'kode_praktikum' => 'PCD2406',
                'nama_pertemuan' => 'Pertemuan 4: Image Segmentation',
                'pertemuan_ke' => 4,
                'deskripsi_pertemuan' => 'Segmentasi citra menggunakan thresholding dan region-based methods.',
            ],

            // --- Internet of Things (IOT2407) ---
            [
                'kode_praktikum' => 'IOT2407',
                'nama_pertemuan' => 'Pertemuan 1: IoT Fundamentals',
                'pertemuan_ke' => 1,
                'deskripsi_pertemuan' => 'Pengenalan konsep IoT, arsitektur, dan protokol komunikasi.',
            ],
            [
                'kode_praktikum' => 'IOT2407',
                'nama_pertemuan' => 'Pertemuan 2: Microcontroller & Sensor',
                'pertemuan_ke' => 2,
                'deskripsi_pertemuan' => 'Pemrograman microcontroller Arduino dan integrasi dengan sensor.',
            ],
            [
                'kode_praktikum' => 'IOT2407',
                'nama_pertemuan' => 'Pertemuan 3: Wireless Communication',
                'pertemuan_ke' => 3,
                'deskripsi_pertemuan' => 'Komunikasi wireless menggunakan WiFi, Bluetooth, dan LoRaWAN.',
            ],
            [
                'kode_praktikum' => 'IOT2407',
                'nama_pertemuan' => 'Pertemuan 4: Cloud & Data Analytics',
                'pertemuan_ke' => 4,
                'deskripsi_pertemuan' => 'Integrasi dengan cloud platform dan analisis data IoT.',
            ],

            // --- Rekayasa Perangkat Lunak (RPL2408) ---
            [
                'kode_praktikum' => 'RPL2408',
                'nama_pertemuan' => 'Pertemuan 1: Pengenalan Tools RPL',
                'pertemuan_ke' => 1,
                'deskripsi_pertemuan' => 'Pengenalan tools pengembangan software seperti Git, VS Code, dan CASE tools.',
            ],
            [
                'kode_praktikum' => 'RPL2408',
                'nama_pertemuan' => 'Pertemuan 2: Use Case Diagram',
                'pertemuan_ke' => 2,
                'deskripsi_pertemuan' => 'Pembuatan use case diagram untuk analisis kebutuhan sistem.',
            ],
            [
                'kode_praktikum' => 'RPL2408',
                'nama_pertemuan' => 'Pertemuan 3: Class & ER Diagram',
                'pertemuan_ke' => 3,
                'deskripsi_pertemuan' => 'Pembuatan class diagram dan entity relationship diagram.',
            ],
            [
                'kode_praktikum' => 'RPL2408',
                'nama_pertemuan' => 'Pertemuan 4: Testing & Documentation',
                'pertemuan_ke' => 4,
                'deskripsi_pertemuan' => 'Unit testing, integration testing, dan dokumentasi software.',
            ],

            // --- Pemrograman Web (WEB2401) ---
            [
                'kode_praktikum' => 'WEB2401',
                'nama_pertemuan' => 'Pertemuan 1: HTML & CSS Basics',
                'pertemuan_ke' => 1,
                'deskripsi_pertemuan' => 'Pengenalan HTML, CSS, dan responsive web design.',
            ],
            [
                'kode_praktikum' => 'WEB2401',
                'nama_pertemuan' => 'Pertemuan 2: JavaScript Fundamentals',
                'pertemuan_ke' => 2,
                'deskripsi_pertemuan' => 'Dasar-dasar JavaScript dan DOM manipulation.',
            ],
            [
                'kode_praktikum' => 'WEB2401',
                'nama_pertemuan' => 'Pertemuan 3: Backend with PHP/Laravel',
                'pertemuan_ke' => 3,
                'deskripsi_pertemuan' => 'Pemrograman backend menggunakan PHP/Laravel framework.',
            ],
            [
                'kode_praktikum' => 'WEB2401',
                'nama_pertemuan' => 'Pertemuan 4: Database Integration',
                'pertemuan_ke' => 4,
                'deskripsi_pertemuan' => 'Integrasi database dengan web application.',
            ],
        ];

        foreach ($pertemuans as $pertemuan) {
            // Get the jadwal ID based on kode_praktikum
            $jadwal = Jadwal::where('kode_praktikum', $pertemuan['kode_praktikum'])->first();
            
            if ($jadwal) {
                $pertemuan['id_jadwal'] = $jadwal->id;
                Pertemuan::create($pertemuan);
            }
        }
    }
}
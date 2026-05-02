<?php

namespace Database\Seeders;

use App\Models\Praktikum;
use Illuminate\Database\Seeder;

class PraktikumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Praktikum::create([
            'kode_praktikum' => 'PRAK001',
            'nama_praktikum' => 'Praktikum Dasar Pemrograman',
            'angkatan' => 2023,
            'semester' => 1,
        ]);

        Praktikum::create([
            'kode_praktikum' => 'PRAK002',
            'nama_praktikum' => 'Praktikum Struktur Data',
            'angkatan' => 2023,
            'semester' => 2,
        ]);

        Praktikum::create([
            'kode_praktikum' => 'PRAK003',
            'nama_praktikum' => 'Praktikum Algoritma',
            'angkatan' => 2023,
            'semester' => 3,
        ]);

        Praktikum::create([
            'kode_praktikum' => 'PRAK004',
            'nama_praktikum' => 'Praktikum Database',
            'angkatan' => 2023,
            'semester' => 4,
        ]);

        Praktikum::create([
            'kode_praktikum' => 'PRAK005',
            'nama_praktikum' => 'Praktikum Web Development',
            'angkatan' => 2024,
            'semester' => 1,
        ]);

        Praktikum::create([
            'kode_praktikum' => 'PRAK006',
            'nama_praktikum' => 'Praktikum Mobile Development',
            'angkatan' => 2024,
            'semester' => 2,
        ]);
    }
}

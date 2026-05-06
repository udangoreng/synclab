<?php

namespace Database\Seeders;

use App\Models\Praktikum;
use App\Models\User;
use Illuminate\Database\Seeder;

class PraktikumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get dosens dengan nomor_induk (yang merupakan FK reference)
        $dosens = User::where('role', 'Dosen')->get();
        
        if ($dosens->isEmpty()) {
            return;
        }

        $praktikums = [
            [
                'kode_praktikum' => 'PD2401',
                'nama_praktikum' => 'Pemrograman Dasar',
                'id_dosen' => $dosens[0]->nomor_induk, 
                'angkatan' => 2024,
                'semester' => 2,
            ],
            [
                'kode_praktikum' => 'SD2402',
                'nama_praktikum' => 'Struktur Data',
                'id_dosen' => $dosens[1]->nomor_induk,
                'angkatan' => 2024,
                'semester' => 2,
            ],
            [
                'kode_praktikum' => 'BD2403',
                'nama_praktikum' => 'Basis Data',
                'id_dosen' => $dosens[2]->nomor_induk,
                'angkatan' => 2024,
                'semester' => 2,
            ],
            [
                'kode_praktikum' => 'JARKOM2404',
                'nama_praktikum' => 'Jaringan Komputer',
                'id_dosen' => $dosens[3]->nomor_induk,
                'angkatan' => 2024,
                'semester' => 2,
            ],
            [
                'kode_praktikum' => 'PCD2406',
                'nama_praktikum' => 'Pengolahan Citra Digital',
                'id_dosen' => $dosens[4]->nomor_induk,
                'angkatan' => 2024,
                'semester' => 2,
            ],
            [
                'kode_praktikum' => 'RPL2408',
                'nama_praktikum' => 'Rekayasa Perangkat Lunak (RPL)',
<<<<<<< HEAD
                'id_dosen' => $dosens[5]->nomor_induk,
=======
                'id_dosen' => $dosens[7]->nomor_induk,
                'angkatan' => 2024,
                'semester' => 2,
            ],
            [
                'kode_praktikum' => 'WEB2401',
                'nama_praktikum' => 'Pemrograman Web',
                'id_dosen' => $dosens[7]->nomor_induk,
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423
                'angkatan' => 2024,
                'semester' => 2,
            ],
        ];

        foreach ($praktikums as $praktikum) {
            Praktikum::create($praktikum);
        }
    }
}

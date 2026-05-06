<?php

namespace Database\Seeders;

use App\Models\Laboratorium;
use App\Models\User;
use Illuminate\Database\Seeder;

class LaboratoriumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // Get or create a user to be kepala_lab (head of lab)
        $kepalaLab = User::where('role', 'Admin')->first();
        
        if ($kepalaLab) {
            Laboratorium::create([
                'kode_laboratorium' => 'LKAT1',
                'nama_laboratorium' => 'Lab Komputer A',
                'lokasi' => 'Gedung Teknik Lantai 1',
                'kapasitas' => 30,
                'kepala_lab' => $kepalaLab->id,
                'status' => 'Tersedia',
            ]);

            Laboratorium::create([
                'kode_laboratorium' => 'LKBT2',
                'nama_laboratorium' => 'Lab Komputer B',
                'lokasi' => 'Gedung Teknik Lantai 2',
                'kapasitas' => 25,
                'kepala_lab' => $kepalaLab->id,
                'status' => 'Terpakai',
            ]);

            Laboratorium::create([
                'kode_laboratorium' => 'LJARKOMT3',
                'nama_laboratorium' => 'Lab Networking',
                'lokasi' => 'Gedung Teknik Lantai 3',
                'kapasitas' => 20,
                'kepala_lab' => $kepalaLab->id,
                'status' => 'Tersedia',
            ]);

            Laboratorium::create([
                'kode_laboratorium' => 'LRPLT2',
                'nama_laboratorium' => 'Lab Rekayasa Perangkat Lunak',
                'lokasi' => 'Gedung Teknik Lantai 2',
                'kapasitas' => 15,
                'kepala_lab' => $kepalaLab->id,
                'status' => 'Tersedia',
            ]);
=======
        // Get admin users untuk kepala lab (bukan dosen)
        $admins = User::where('role', 'Admin')->get();
        
        if ($admins->isEmpty()) {
            return;
        }

        $laboratoriums = [
            [
                'kode_laboratorium' => 'LAB001',
                'nama_laboratorium' => 'Lab Komputer A - Pemrograman',
                'lokasi' => 'Gedung A Lt. 1',
                'kapasitas' => 30,
                'kepala_lab' => $admins[0]->id,
                'status' => 'Tersedia',
            ],
            [
                'kode_laboratorium' => 'LAB002',
                'nama_laboratorium' => 'Lab Komputer B - Dasar',
                'lokasi' => 'Gedung A Lt. 2',
                'kapasitas' => 25,
                'kepala_lab' => $admins[1]->id,
                'status' => 'Tersedia',
            ],
            [
                'kode_laboratorium' => 'LAB003',
                'nama_laboratorium' => 'Lab Jaringan - Network',
                'lokasi' => 'Gedung B Lt. 1',
                'kapasitas' => 20,
                'kepala_lab' => $admins[2]->id,
                'status' => 'Tersedia',
            ],
            [
                'kode_laboratorium' => 'LAB004',
                'nama_laboratorium' => 'Lab Multimedia - Design',
                'lokasi' => 'Gedung B Lt. 2',
                'kapasitas' => 15,
                'kepala_lab' => $admins[3]->id,
                'status' => 'Tersedia',
            ],
            [
                'kode_laboratorium' => 'LAB005',
                'nama_laboratorium' => 'Lab Database - SQL Server',
                'lokasi' => 'Gedung C Lt. 1',
                'kapasitas' => 20,
                'kepala_lab' => $admins[4]->id,
                'status' => 'Tersedia',
            ],
        ];

        foreach ($laboratoriums as $lab) {
            Laboratorium::create($lab);
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423
        }
    }
}

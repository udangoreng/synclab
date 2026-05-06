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
        }
    }
}

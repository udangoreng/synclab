<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranPraktikumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pendaftaran_praktikum')->insert([
            [
                'id_praktikum' => 1,
                'id_user' => 3,
                'role' => 'Asisten',
                'status' => 'Dikonfirmasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_praktikum' => 1,
                'id_user' => 4, 
                'role' => 'Asisten',
                'status' => 'Dikonfirmasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_praktikum' => 3,
                'id_user' => 4,
                'role' => 'Asisten',
                'status' => 'Dikonfirmasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_praktikum' => 2,
                'id_user' => 3,
                'role' => 'Praktikan',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

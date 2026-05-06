<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders in order of dependencies
        // User harus pertama karena dibutuhkan oleh seeder lain
        $this->call([
            UserSeeder::class,
            LaboratoriumSeeder::class,
            PraktikumSeeder::class,
            JadwalSeeder::class,
            PertemuanSeeder::class,
            ModulSeeder::class,
            LaporanSeeder::class,
            PendaftaranPraktikumSeeder::class,
            PresensiSeeder::class,
            NilaiSeeder::class,
            PengumpulanLaporanSeeder::class,
        ]);
    }
}

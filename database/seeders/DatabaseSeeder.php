<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\LaboratoriumSeeder;
use Database\Seeders\PraktikumSeeder;
use Database\Seeders\PendaftaranPraktikumSeeder;

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
            PertemuanSeeder::class,
            JadwalSeeder::class,
            ModulSeeder::class,
            LaporanSeeder::class,
            PendaftaranPraktikumSeeder::class,
            PresensiSeeder::class,
            NilaiSeeder::class,
            PengumpulanLaporanSeeder::class,
        ]);
    }
}

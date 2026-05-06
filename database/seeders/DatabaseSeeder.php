<?php

namespace Database\Seeders;

use Database\Seeders\LaboratoriumSeeder;
use Database\Seeders\PraktikumSeeder;
use Database\Seeders\PendaftaranPraktikumSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\JadwalSeeder;
use Database\Seeders\PertemuanSeeder;
use Database\Seeders\ModulSeeder;
use Database\Seeders\LaporanSeeder;
use Database\Seeders\PresensiSeeder;
use Database\Seeders\NilaiSeeder;
use Database\Seeders\PengumpulanLaporanSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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

<?php

namespace Database\Seeders;

use App\Models\PendaftaranPraktikum;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Database\Seeder;

class PendaftaranPraktikumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hanya jadwal untuk pertemuan 1-3 karena user sedang di pertemuan 3
        $pertemuanIds = \App\Models\Pertemuan::where('pertemuan_ke', '<=', 3)->pluck('id');
        $jadwals = Jadwal::whereIn('id_pertemuan', $pertemuanIds)->get();
        $praktikans = User::where('role', 'Praktikan')->get();
        $asistens = User::where('role', 'Asisten')->get();

        if ($jadwals->isEmpty() || $praktikans->isEmpty()) {
            return;
        }

        $pendaftarans = [];

        // Setiap jadwal didaftarkan beberapa praktikan
        foreach ($jadwals as $jadwal) {
            // Tambahkan 8-10 praktikan per jadwal
            $praktikanCount = min(8, $praktikans->count());
            for ($i = 0; $i < $praktikanCount; $i++) {
                $praktikan = $praktikans[$i];
                
                // Cek apakah sudah terdaftar
                if (!PendaftaranPraktikum::where('id_jadwal', $jadwal->id)
                    ->where('id_user', $praktikan->id)
                    ->exists()) {
                    $pendaftarans[] = [
                        'id_jadwal' => $jadwal->id,
                        'id_user' => $praktikan->id,
                        'role' => 'Praktikan',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // Tambahkan 1-2 asisten per jadwal
            if ($asistens->count() > 0) {
                $asisten = $asistens[($jadwal->id - 1) % $asistens->count()];
                
                if (!PendaftaranPraktikum::where('id_jadwal', $jadwal->id)
                    ->where('id_user', $asisten->id)
                    ->exists()) {
                    $pendaftarans[] = [
                        'id_jadwal' => $jadwal->id,
                        'id_user' => $asisten->id,
                        'role' => 'Asisten',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        // Insert dalam batch
        if (!empty($pendaftarans)) {
            PendaftaranPraktikum::insert($pendaftarans);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\PendaftaranPraktikum;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PendaftaranPraktikumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Fetch data
        $jadwals = Jadwal::all();
        $praktikans = User::where('role', 'Praktikan')->get();
        $asistens = User::where('role', 'Asisten')->get();

        // 2. Safety check
        if ($jadwals->isEmpty() || $praktikans->isEmpty()) {
            $this->command->warn("Data Jadwal atau Praktikan kosong. Seeder dilewati.");
            return;
        }

        $pendaftarans = [];
        $now = Carbon::now();

        // 3. Loop through each schedule
        foreach ($jadwals as $jadwal) {
            
            // --- ADD PRAKTIKAN ---
            // Take 8 random students for this schedule
            $selectedPraktikans = $praktikans->random(min(8, $praktikans->count()));

            foreach ($selectedPraktikans as $praktikan) {
                $pendaftarans[] = [
                    'id_jadwal' => $jadwal->id,
                    'id_user'   => $praktikan->id, 
                    'role'      => 'Praktikan',
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            // --- ADD ASISTEN ---
            // Take 1-2 random assistants for this schedule
            $asistenCount = min(2, $asistens->count());
            if ($asistenCount > 0) {
                $selectedAsistens = $asistens->random($asistenCount);

                foreach ($selectedAsistens as $asisten) {
                    $pendaftarans[] = [
                        'id_jadwal' => $jadwal->id,
                        'id_user'   => $asisten->id,
                        'role'      => 'Asisten',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
        }

        // 4. Batch Insert (More efficient than looping inside the loop)
        // We use collect()->unique() to prevent primary/unique key violations
        $chunks = collect($pendaftarans)->unique(function ($item) {
            return $item['id_jadwal'].$item['id_user'];
        })->chunk(100);

        foreach ($chunks as $chunk) {
            PendaftaranPraktikum::insert($chunk->toArray());
        }
    }
}
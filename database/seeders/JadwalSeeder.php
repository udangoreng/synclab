<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Laboratorium;
use App\Models\Pertemuan;
use App\Models\Praktikum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $praktikums = Praktikum::all()->keyBy('kode_praktikum');
        $pertemuans = Pertemuan::with('praktikum')->get();
        $dosens = User::where('role', 'Dosen')->get();
        $laboratoriums = Laboratorium::all();

        if ($praktikums->isEmpty() || $pertemuans->isEmpty() || $dosens->isEmpty() || $laboratoriums->isEmpty()) {
            return;
        }

        $startOfCurrentWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $intervalOffsets = [
            1 => -4,
            2 => -2,
            3 => 0,
            4 => 2,
            5 => 4,
            6 => 6,
        ];
        $timeSlots = [
            '08:00:00',
            '09:30:00',
            '11:00:00',
            '13:00:00',
            '14:30:00',
            '16:00:00',
            '18:00:00',
        ];

        $praktikums->each(function ($praktikum) use ($pertemuans, $dosens, $laboratoriums, $startOfCurrentWeek, $intervalOffsets, $timeSlots) {
            for ($ke = 1; $ke <= 6; $ke++) {
                $pertemuan = $pertemuans->first(function($item) use ($praktikum, $ke) {
                    return $item->praktikum->kode_praktikum === $praktikum->kode_praktikum &&
                        $item->pertemuan_ke === $ke;
                });

                if (! $pertemuan) {
                    continue;
                }

                $intervalStart = $startOfCurrentWeek->copy()->addWeeks($intervalOffsets[$ke]);

                for ($index = 0; $index < 7; $index++) {
                    $slotDate = $intervalStart->copy()->addDays($index);
                    $startTime = $timeSlots[$index % count($timeSlots)];
                    $endTime = Carbon::createFromFormat('H:i:s', $startTime)->addMinutes(90)->format('H:i:s');

                    // Tentukan status berdasarkan tanggal:
                    // - Selesai: jika tanggal sudah lewat (< hari ini)
                    // - Dibuka: jika dalam range 7 hari ke depan atau masih dalam minggu pertemuan
                    // - Selesai: jika tanggal melebihi 7 hari ke depan
                    $now = Carbon::now();
                    $daysFromToday = $slotDate->diffInDays($now, false); // negative if past, positive if future
                    
                    if ($daysFromToday < 0) {
                        // Sudah lewat, status Selesai
                        $status = 'Selesai';
                    } elseif ($daysFromToday <= 7) {
                        // Dalam 7 hari ke depan, status Dibuka (active)
                        $status = 'Dibuka';
                    } else {
                        // Lebih dari 7 hari ke depan, status Selesai (untuk upcoming praktikum)
                        $status = 'Selesai';
                    }

                    Jadwal::create([
                        'id_praktikum' => $praktikum->id,
                        'id_dosen' => $dosens[($pertemuan->pertemuan_ke - 1 + $index) % $dosens->count()]->nomor_induk,
                        'id_pertemuan' => $pertemuan->id,
                        'id_laboratorium' => $laboratoriums[$index % $laboratoriums->count()]->id,
                        'tanggal' => $slotDate->toDateString(),
                        'jam_mulai' => $startTime,
                        'jam_selesai' => $endTime,
                        'jumlah_max_peserta' => 20 + ($index % 4) * 5,
                        'status' => $status,
                    ]);
                }
            }
        });
    }
}

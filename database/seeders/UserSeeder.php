<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Budi Kangoding',
            'email' => 'admin@abc.c',
            'password' => Hash::make('admin123'),
            'nomor_induk' => 'LAB001',
            'role' => 'Admin',
        ]);

        User::create([
            'nama' => 'Prof Dr Ir Alek SH Skom Sj St Sd Smp',
            'email' => 'dosen@ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => 'NIDN0987654321',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Andi IMPHNEN',
            'email' => 'asisten@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001001',
            'role' => 'Asisten',
        ]);

        User::create([
            'nama' => 'Eri Sepuh',
            'email' => 'epuh@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022005005',
            'role' => 'Praktikan',
        ]);
    }
}

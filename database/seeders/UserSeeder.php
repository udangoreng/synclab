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
        // Admin - kepala lab dan admin sistem
        User::create([
            'nama' => 'Budi Kangoding',
            'email' => 'admin@univ.ac.id',
            'password' => Hash::make('admin123'),
            'nomor_induk' => '199001011990',
            'role' => 'Admin',
        ]);
            
        User::create([
            'nama' => 'Sri Wahyu Hartono',
            'email' => 'admin.lab.a@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198801011988',
            'role' => 'Admin',
        ]);

        User::create([
            'nama' => 'Hendra Gunawan',
            'email' => 'admin.lab.b@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198902011989',
            'role' => 'Admin',
        ]);

        User::create([
            'nama' => 'Dewi Sartika',
            'email' => 'admin.lab.jaringan@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '199003011990',
            'role' => 'Admin',
        ]);

        User::create([
            'nama' => 'Bambang Supriyadi',
            'email' => 'admin.lab.multimedia@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198703011987',
            'role' => 'Admin',
        ]);

        User::create([
            'nama' => 'Ratna Wijaya',
            'email' => 'admin.lab.database@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198804011988',
            'role' => 'Admin',
        ]);

        // Dosen - untuk praktikum berbeda
        User::create([
            'nama' => 'Dr. Alek Skom, M.Kom',
            'email' => 'alek.skom@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198501011985',
            'role' => 'Dosen',
        ]);
                
        User::create([
            'nama' => 'Prof. Budi Santoso, S.Kom, M.Sc',
            'email' => 'budi.santoso@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198102011981',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Dr. Siti Nurhaliza, M.Kom',
            'email' => 'siti.nurhaliza@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198703011110',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Ir. Ahmad Wijaya, M.T',
            'email' => 'ahmad.wijaya@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198604011986',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Dr. Rini Handayani, M.Kom',
            'email' => 'rini.handayani@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198805011988',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Dr. Hendra Wijaya, S.Kom, M.Kom',
            'email' => 'hendra.wijaya@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '199002011990',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Rina Setiawati, S.Kom, M.Kom',
            'email' => 'rina.setiawati@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '199103011991',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Dr. Bambang Sutrisno, S.Kom, M.T',
            'email' => 'bambang.sutrisno@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198702011987',
            'role' => 'Dosen',
        ]);

        // Asisten - untuk membantu dosen
        User::create([
            'nama' => 'Andi Imphnen Arifianto',
            'email' => 'andi.imphnen@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001001',
            'role' => 'Asisten',
        ]);

        User::create([
            'nama' => 'Reza Pratama Wardhana',
            'email' => 'reza.pratama@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001002',
            'role' => 'Asisten',
        ]);

        User::create([
            'nama' => 'Siti Mardhiah Pratiwi',
            'email' => 'siti.mardhiah@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001003',
            'role' => 'Asisten',
        ]);

        User::create([
            'nama' => 'Fauzan Akbar Ikhsan',
            'email' => 'fauzan.akbar@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001004',
            'role' => 'Asisten',
        ]);

        User::create([
            'nama' => 'Nur Aini Kamila',
            'email' => 'nur.aini@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001005',
            'role' => 'Asisten',
        ]);

        // Praktikan
        User::create([
            'nama' => 'Eri Sepuh',
            'email' => 'eri.sepuh@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001001',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Rizka Aulia Putri',
            'email' => 'rizka.aulia@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001002',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Doni Setiawan',
            'email' => 'doni.setiawan@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001003',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Lina Kusuma Dewi',
            'email' => 'lina.kusuma@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001004',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Arif Hidayatullah',
            'email' => 'arif.hidayatullah@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001005',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Nurul Azizah Rafika',
            'email' => 'nurul.azizah@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001006',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Maudy Kristian Kurnia',
            'email' => 'maudy.kristian@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001007',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Faiqah Zahra Wijaya',
            'email' => 'faiqah.zahra@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001008',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Hendra Setiawan',
            'email' => 'hendra.setiawan@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001009',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Intan Permatasari',
            'email' => 'intan.permatasari@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001010',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Muhammad Rizki Santoso',
            'email' => 'rizki.santoso@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2023001001',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Sinta Rahayu Wijaya',
            'email' => 'sinta.rahayu@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2023001002',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Wiranto Kusuma',
            'email' => 'wiranto.kusuma@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2023001003',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Eka Sulistyowati',
            'email' => 'eka.sulistyo@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2023001004',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Gunawan Hermawan',
            'email' => 'gunawan.hermawan@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2023001005',
            'role' => 'Praktikan',
        ]);
    }
}

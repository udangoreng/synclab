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
            'nohp' => '08123456789',
            'role' => 'Admin',
        ]);
            
        User::create([
            'nama' => 'Sri Wahyu Hartono',
            'email' => 'admin.lab.a@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198801011988',
            'nohp' => '08234567890',
            'role' => 'Admin',
        ]);

        User::create([
            'nama' => 'Hendra Gunawan',
            'email' => 'admin.lab.b@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198902011989',
            'nohp' => '08345678901',
            'role' => 'Admin',
        ]);

        User::create([
            'nama' => 'Dewi Sartika',
            'email' => 'admin.lab.jaringan@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '199003011990',
            'nohp' => '08456789012',
            'role' => 'Admin',
        ]);

        User::create([
            'nama' => 'Bambang Supriyadi',
            'email' => 'admin.lab.multimedia@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198703011987',
            'nohp' => '08567890123',
            'role' => 'Admin',
        ]);

        User::create([
            'nama' => 'Ratna Wijaya',
            'email' => 'admin.lab.database@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198804011988',
            'nohp' => '08678901234',
            'role' => 'Admin',
        ]);

        // Dosen - untuk praktikum berbeda
        User::create([
            'nama' => 'Dr. Alek Skom, M.Kom',
            'email' => 'alek.skom@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198501011985',
            'nohp' => '08789012345',
            'role' => 'Dosen',
        ]);
                
        User::create([
            'nama' => 'Prof. Budi Santoso, S.Kom, M.Sc',
            'email' => 'budi.santoso@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198102011981',
            'nohp' => '08890123456',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Dr. Siti Nurhaliza, M.Kom',
            'email' => 'siti.nurhaliza@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198703011110',
            'nohp' => '08901234567',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Ir. Ahmad Wijaya, M.T',
            'email' => 'ahmad.wijaya@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198604011986',
            'nohp' => '08112233445',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Dr. Rini Handayani, M.Kom',
            'email' => 'rini.handayani@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198805011988',
            'nohp' => '08223344556',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Dr. Hendra Wijaya, S.Kom, M.Kom',
            'email' => 'hendra.wijaya@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '199002011990',
            'nohp' => '08334455667',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Rina Setiawati, S.Kom, M.Kom',
            'email' => 'rina.setiawati@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '199103011991',
            'nohp' => '08445566778',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Dr. Bambang Sutrisno, S.Kom, M.T',
            'email' => 'bambang.sutrisno@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '198702011987',
            'nohp' => '08556677889',
            'role' => 'Dosen',
        ]);

        // Asisten - untuk membantu dosen
        User::create([
            'nama' => 'Andi Imphnen Arifianto',
            'email' => 'andi.imphnen@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001001',
            'nohp' => '08667788990',
            'role' => 'Asisten',
        ]);

        User::create([
            'nama' => 'Reza Pratama Wardhana',
            'email' => 'reza.pratama@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001002',
            'nohp' => '08778899001',
            'role' => 'Asisten',
        ]);

        User::create([
            'nama' => 'Siti Mardhiah Pratiwi',
            'email' => 'siti.mardhiah@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001003',
            'nohp' => '08889900112',
            'role' => 'Asisten',
        ]);

        User::create([
            'nama' => 'Fauzan Akbar Ikhsan',
            'email' => 'fauzan.akbar@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001004',
            'nohp' => '08990011223',
            'role' => 'Asisten',
        ]);

        User::create([
            'nama' => 'Nur Aini Kamila',
            'email' => 'nur.aini@univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2021001005',
            'nohp' => '08101122334',
            'role' => 'Asisten',
        ]);

        // Praktikan
        User::create([
            'nama' => 'Eri Sepuh',
            'email' => 'eri.sepuh@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001001',
            'nohp' => '08212233445',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Rizka Aulia Putri',
            'email' => 'rizka.aulia@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001002',
            'nohp' => '08323344556',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Doni Setiawan',
            'email' => 'doni.setiawan@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001003',
            'nohp' => '08434455667',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Lina Kusuma Dewi',
            'email' => 'lina.kusuma@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001004',
            'nohp' => '08545566778',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Arif Hidayatullah',
            'email' => 'arif.hidayatullah@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001005',
            'nohp' => '08656677889',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Nurul Azizah Rafika',
            'email' => 'nurul.azizah@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001006',
            'nohp' => '08767788990',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Maudy Kristian Kurnia',
            'email' => 'maudy.kristian@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001007',
            'nohp' => '08878899001',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Faiqah Zahra Wijaya',
            'email' => 'faiqah.zahra@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001008',
            'nohp' => '08989900112',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Hendra Setiawan',
            'email' => 'hendra.setiawan@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001009',
            'nohp' => '08190011223',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Intan Permatasari',
            'email' => 'intan.permatasari@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2022001010',
            'nohp' => '08201122334',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Muhammad Rizki Santoso',
            'email' => 'rizki.santoso@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2023001001',
            'nohp' => '08312233445',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Sinta Rahayu Wijaya',
            'email' => 'sinta.rahayu@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2023001002',
            'nohp' => '08423344556',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Wiranto Kusuma',
            'email' => 'wiranto.kusuma@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2023001003',
            'nohp' => '08534455667',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Eka Sulistyowati',
            'email' => 'eka.sulistyo@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2023001004',
            'nohp' => '08645566778',
            'role' => 'Praktikan',
        ]);

        User::create([
            'nama' => 'Gunawan Hermawan',
            'email' => 'gunawan.hermawan@student.univ.ac.id',
            'password' => Hash::make('password123'),
            'nomor_induk' => '2023001005',
            'nohp' => '08756677889',
            'role' => 'Praktikan',
        ]);
    }
}

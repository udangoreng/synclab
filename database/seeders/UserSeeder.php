<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private int $phoneCounter = 890;

    private function phone(): string
    {
        return '081234567' . str_pad($this->phoneCounter++, 3, '0', STR_PAD_LEFT);
    }

    public function run(): void
    {
        $users = [

            // Admin
            ['Budi Kangoding', 'admin@abc.c', '199001011990', 'Admin'],
            ['Sri Wahyu Hartono', 'admin.lab.a@univ.ac.id', '198801011988', 'Admin'],
            ['Hendra Gunawan', 'admin.lab.b@univ.ac.id', '198902011989', 'Admin'],
            ['Dewi Sartika', 'admin.lab.jaringan@univ.ac.id', '199003011990', 'Admin'],
            ['Bambang Supriyadi', 'admin.lab.multimedia@univ.ac.id', '198703011987', 'Admin'],
            ['Ratna Wijaya', 'admin.lab.database@univ.ac.id', '198804011988', 'Admin'],

            // Dosen
            ['Dr. Alek Skom, M.Kom', 'alek.skom@univ.ac.id', '198501011985', 'Dosen'],
            ['Prof. Budi Santoso, S.Kom, M.Sc', 'budi.santoso@univ.ac.id', '198102011981', 'Dosen'],
            ['Dr. Siti Nurhaliza, M.Kom', 'siti.nurhaliza@univ.ac.id', '198703011110', 'Dosen'],
            ['Ir. Ahmad Wijaya, M.T', 'ahmad.wijaya@univ.ac.id', '198604011986', 'Dosen'],
            ['Dr. Rini Handayani, M.Kom', 'rini.handayani@univ.ac.id', '198805011988', 'Dosen'],
            ['Dr. Hendra Wijaya, S.Kom, M.Kom', 'hendra.wijaya@univ.ac.id', '199002011990', 'Dosen'],
            ['Rina Setiawati, S.Kom, M.Kom', 'rina.setiawati@univ.ac.id', '199103011991', 'Dosen'],
            ['Dr. Bambang Sutrisno, S.Kom, M.T', 'bambang.sutrisno@univ.ac.id', '198702011987', 'Dosen'],
            ['Dr. Bambang, S.Kom, M.T', 'bambango@univ.ac.id', '198702010819', 'Dosen'],

            // Asisten
            ['Andi Imphnen Arifianto', 'andi.imphnen@univ.ac.id', '2021001001', 'Asisten'],
            ['Eri Sepuh', 'epuh@univ.ac.id', '2021001002', 'Asisten'],
            ['Siti Mardhiah Pratiwi', 'siti.mardhiah@univ.ac.id', '2021001003', 'Asisten'],
            ['Fauzan Akbar Ikhsan', 'fauzan.akbar@univ.ac.id', '2021001004', 'Asisten'],
            ['Nur Aini Kamila', 'nur.aini@univ.ac.id', '2021001005', 'Asisten'],

            // Praktikan
            ['Eri Sepuh', 'eri.sepuh@student.univ.ac.id', '2022001001', 'Praktikan'],
            ['Rizka Aulia Putri', 'rizka.aulia@student.univ.ac.id', '2022001002', 'Praktikan'],
            ['Doni Setiawan', 'doni.setiawan@student.univ.ac.id', '2022001003', 'Praktikan'],
            ['Lina Kusuma Dewi', 'lina.kusuma@student.univ.ac.id', '2022001004', 'Praktikan'],
            ['Arif Hidayatullah', 'arif.hidayatullah@student.univ.ac.id', '2022001005', 'Praktikan'],
            ['Nurul Azizah Rafika', 'nurul.azizah@student.univ.ac.id', '2022001006', 'Praktikan'],
            ['Maudy Kristian Kurnia', 'maudy.kristian@student.univ.ac.id', '2022001007', 'Praktikan'],
            ['Faiqah Zahra Wijaya', 'faiqah.zahra@student.univ.ac.id', '2022001008', 'Praktikan'],
            ['Hendra Setiawan', 'hendra.setiawan@student.univ.ac.id', '2022001009', 'Praktikan'],
            ['Intan Permatasari', 'intan.permatasari@student.univ.ac.id', '2022001010', 'Praktikan'],
            ['Muhammad Rizki Santoso', 'rizki.santoso@student.univ.ac.id', '2023001001', 'Praktikan'],
            ['Sinta Rahayu Wijaya', 'sinta.rahayu@student.univ.ac.id', '2023001002', 'Praktikan'],
            ['Wiranto Kusuma', 'wiranto.kusuma@student.univ.ac.id', '2023001003', 'Praktikan'],
            ['Eka Sulistyowati', 'eka.sulistyo@student.univ.ac.id', '2023001004', 'Praktikan'],
            ['Gunawan Hermawan', 'gunawan.hermawan@student.univ.ac.id', '2023001005', 'Praktikan'],
        ];

        foreach ($users as [$nama, $email, $nomor_induk, $role]) {
            User::create([
                'nama' => $nama,
                'email' => $email,
                'nohp' => $this->phone(),
                'password' => Hash::make('password123'),
                'nomor_induk' => $nomor_induk,
                'role' => $role,
            ]);
        }
    }
}
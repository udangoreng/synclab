<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Praktikum;
use App\Models\Jadwal;
use App\Models\Laporan;
use App\Models\Presensi;
use App\Models\Nilai;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    function index()
    {
        return view('login');
    }

    public function welcome()
    {
        return view('landing');
    }

    function login(Request $request)
    {

        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email Harus Diisi!',
                'password.required' => 'Password Harus Diisi!'
            ]
        );

        $credetials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credetials)) {
            if (Auth::user()->role == 'Admin') {
                return redirect('/admin');
            } else if (Auth::user()->role == 'Praktikan') {
                return redirect('/mahasiswa');
            } else if (Auth::user()->role == 'Asisten') {
                return redirect('/asisten');
            } else if (Auth::user()->role == 'Dosen') {
                return redirect('/dosen');
            }
        } else {
            return redirect('/login')->withErrors('Username dan Password yang Dimasukkan Tidak Sesuai!')->withInput();
        }
    }

    function register()
    {
        return view('register');
    }

    function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nomor_induk' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.unique'        => 'Email ini sudah terdaftar, gunakan email lain.',
            'nomor_induk.unique'  => 'NIM/NIP ini sudah terdaftar.',
            'password.min'        => 'Password minimal 8 karakter.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
            'nama.required'       => 'Nama lengkap harus diisi.',
            'email.required'      => 'Email harus diisi.',
            'nomor_induk.required' => 'NIM/NIP harus diisi.',
            'password.required'   => 'Password harus diisi.',
        ]);

        $firstChar = substr($request->nomor_induk, 0, 1);
        $role = (in_array($firstChar, ['0', '1'])) ? 'Dosen' : 'Praktikan';

        User::create([
            'nomor_induk' => $request->nomor_induk,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $role,
        ]);

        return redirect('/login')->with('register_success', true);
    }

    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    function mahasiswa()
    {
        return view('mahasiswa/dashboard');
    }

    function dosen()
    {
        return view('dosen/dashboard');
    }

    function asisten()
    {
        return view('asisten.dashboard_asistent');
    }

    function admin(Request $request)
    {
        $jadwalFilter = $request->get('jadwal_filter', 'hari_ini');
        $praktikumId = $request->get('praktikum_id');
        $pertemuanId = $request->get('pertemuan_id');

        // Basic counts
        $totalPraktikum = Praktikum::count();
        $totalAsisten = User::where('role', 'Asisten')->count();
        $totalPraktikan = User::where('role', 'Praktikan')->count();
        $totalPendaftaran = DB::table('pendaftaran_praktikum')->where('role', 'Praktikan')->count();

        // Today's schedule
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');
        $jadwalHariIni = Jadwal::where('hari', $hariIni)->count();

        // Presensi stats
        $rataPresensi = Presensi::count() > 0 ? (Presensi::where('kehadiran', 'Hadir')->count() / Presensi::count() * 100) : 0;
        $presensiHariIni = Presensi::whereDate('created_at', Carbon::today())->get();
        $presensiHadir = $presensiHariIni->where('kehadiran', 'Hadir')->count();
        $totalPraktikanHariIni = $presensiHariIni->count();
        $presensiHariIniPersen = $totalPraktikanHariIni > 0 ? ($presensiHadir / $totalPraktikanHariIni * 100) : 0;

        // Nilai stats
        $rataNilai = Nilai::avg('nilai_akhir') ?? 0;
        $nilaiTertinggi = Nilai::max('nilai_akhir') ?? 0;
        $nilaiTerendah = Nilai::min('nilai_akhir') ?? 0;

        // Pengumpulan Laporan stats
        $totalLaporan = Laporan::count();
        $laporanTerkumpul = DB::table('pengumpulan_laporan')->whereIn('status', ['Disubmit', 'Ditandai Selesai', 'Dalam Review', 'Diterima'])->count();
        $laporanTerlambat = DB::table('pengumpulan_laporan')->where('status', 'Terlambat')->count();
        $rataPengumpulan = $totalLaporan > 0 ? ($laporanTerkumpul / $totalLaporan * 100) : 0;

        // Warnings
        $warnings = [];
        if ($laporanTerlambat > 0) {
            $warnings[] = "$laporanTerlambat laporan terlambat";
        }
        $jadwalPenuh = Jadwal::where('status', 'Penuh')->count();
        if ($jadwalPenuh > 0) {
            $warnings[] = "$jadwalPenuh jadwal sudah penuh";
        }

        $lastUpdate = Carbon::now()->format('H:i') . ' WIB';

        // Praktikum list
        $praktikums = Praktikum::latest()
            ->limit(6)
            ->get();

        // Jadwal query
        $jadwalQuery = Jadwal::with(['praktikum', 'laboratorium', 'dosen']);

        if ($jadwalFilter == 'hari_ini') {
            $jadwalQuery->where('hari', $hariIni);
        }

        $jadwals = $jadwalQuery->orderBy('jam_mulai', 'asc')->get();

        $bentrokCount = 0;
        $warningsJadwal = null;
        $labSchedule = [];

        foreach ($jadwals as $jadwal) {
            $key = $jadwal->jam_mulai . '-' . $jadwal->id_laboratorium;
            if (isset($labSchedule[$key])) {
                $jadwal->bentrok = true;
                $bentrokCount++;
                $warningsJadwal = "Lab {$jadwal->laboratorium->nama_laboratorium} digunakan 2 jadwal di jam yang sama";
            } else {
                $jadwal->bentrok = false;
                $labSchedule[$key] = true;
            }
        }

        $jadwalGrouped = $jadwals->groupBy('hari');

        $asistenAktif = User::where('role', 'Asisten')
            ->withCount('jadwals')
            ->latest()
            ->limit(5)
            ->get();

        $asistenMengajar = $asistenAktif->filter(function ($a) use ($hariIni) {
            return $a->jadwals->where('hari', $hariIni)->count() > 0;
        })->count();

        return view('laboran/dashboard_lab', compact(
            'totalPraktikum',
            'totalPendaftaran',
            'totalAsisten',
            'totalPraktikan',
            'jadwalHariIni',
            'rataPresensi',
            'presensiHariIniPersen',
            'presensiHadir',
            'totalPraktikanHariIni',
            'rataNilai',
            'nilaiTertinggi',
            'nilaiTerendah',
            'rataPengumpulan',
            'laporanTerkumpul',
            'totalLaporan',
            'laporanTerlambat',
            'warnings',
            'lastUpdate',
            'praktikums',
            'jadwalGrouped',
            'bentrokCount',
            'warningsJadwal',
            'asistenAktif',
            'asistenMengajar',
            'jadwalFilter',
            'hariIni'
        ));
    }
}

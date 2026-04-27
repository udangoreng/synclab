<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index() {
        return view('login');
    }
    
    public function welcome()
    {
        return view('landing');
    }

    function login(Request $request) {
        
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],
        [
            'email.required'=>'Email Harus Diisi!',
            'password.required'=>'Password Harus Diisi!'
        ]);

        $credetials = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($credetials)){
            if(Auth::user()->role == 'Admin'){
                return redirect('/admin');
            } else if(Auth::user()->role == 'Praktikan'){
                return redirect('/mahasiswa');
            } else if(Auth::user()->role == 'Asisten'){
                return redirect('/asisten');
            } else if(Auth::user()->role == 'Dosen'){
                return redirect('/dosen');
            }
        } else{
            return redirect('/login')->withErrors('Username dan Password yang Dimasukkan Tidak Sesuai!')->withInput();
        }
    }

    function register () {
        return view ('register');
    }

    function store(Request $request) {
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
        'nomor_induk.required'=> 'NIM/NIP harus diisi.',
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

    function logout(){
        Auth::logout();
        return redirect('/login');
    }

    function mahasiswa(){
        return view('mahasiswa/dashboard');
    }

    function dosen(){
        return view('dosen/dashboard');
    }

    function asisten(){
        return view('asisten/dashboard_asistent');
    }

    function admin(){
        return view('laboran/dashboard_lab');
    }
}

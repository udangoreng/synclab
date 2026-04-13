<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index() {
        return view('login');
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

    function laboran(){
        return view('mahasiswa/dashboard');
    }
}

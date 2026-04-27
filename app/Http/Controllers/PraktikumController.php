<?php

namespace App\Http\Controllers;

use App\Models\Praktikum;
use Illuminate\Http\Request;

class PraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $praktikums = Praktikum::when($request->search, function ($query, $search) {
            return $query->where('kode_praktikum', 'like', "%{$search}%")
                ->orWhere('nama_praktikum', 'like', "%{$search}%");
        })->paginate(15);

        return view('laboran/kelolaPraktikum_lab', compact('praktikums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_praktikum' => 'required|string|max:255|unique:praktikums',
            'nama_praktikum' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
        ], [
            'kode_praktikum.unique' => 'Kode Ini Telah Dipakai, Harap Mengunakan Kode Lain.',
            'kode_praktikum.required' => 'Kode Praktikum harus diisi.',
            'nama_praktikum.required' => 'Nama Praktikum harus diisi.',
            'angkatan.required'      => 'Angkatan harus diisi.',
            'semester.required' => 'Semester harus diisi.',
        ]);

        Praktikum::create([
            'kode_praktikum' => $request->kode_praktikum,
            'nama_praktikum' => $request->nama_praktikum,
            'angkatan' => $request->angkatan,
            'semester' => $request->semester,
        ]);

        return redirect('/admin/praktikum')->with('success', 'Praktikum berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Praktikum $praktikum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Praktikum $praktikum)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $praktikum = Praktikum::findOrFail($id);

        $request->validate([
            'kode_praktikum' => 'required|string|max:255',
            'nama_praktikum' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
        ], [
            'kode_praktikum.required' => 'Kode Praktikum harus diisi.',
            'nama_praktikum.required' => 'Nama Praktikum harus diisi.',
            'angkatan.required'      => 'Angkatan harus diisi.',
            'semester.required' => 'Semester harus diisi.',
        ]);

        $praktikum->update([
            'kode_praktikum' => $request->kode_praktikum,
            'nama_praktikum' => $request->nama_praktikum,
            'angkatan' => $request->angkatan,
            'semester' => $request->semester,
        ]);

        return redirect('/admin/praktikum')->with('success', 'Praktikum berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $praktikum = Praktikum::findOrFail($id);
        
        $praktikum->delete();
        return redirect('/admin/praktikum');
    }

    function pendaftaranShow()
    {
        return view('mahasiswa/pendaftaran');
    }

    function getMyPraktikum()
    {
        return view('mahasiswa/praktikum');
    }

    function monitoringPraktikum()
    {
        return view('dosen/monitoring');
    }

    function cekStatusPendaftaran()
    {
        return view('dosen/statuspendaftaran');
    }

    function asistensiPraktikum()
    {
        return view('asisten/praktikum_asisten');
    }

    public function masterMonitoring()
    {
        return view('laboran/monitoring_lab');
    }
}

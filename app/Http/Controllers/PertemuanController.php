<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pertemuans = Pertemuan::with(['jadwal', 'jadwal.praktikum', 'jadwal.laboratorium', 'modul'])
            ->when($request->search, function ($q, $search) {
                return $q->where('nama_pertemuan', 'like', "%{$search}%")
                    ->orWhere('deskripsi_pertemuan', 'like', "%{$search}%");
            })
            ->orderBy('pertemuan_ke', 'asc')
            ->paginate(15);

        return view('laboran/kelolaPertemuan_lab', compact('pertemuans'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pertemuan $pertemuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pertemuan $pertemuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pertemuan $pertemuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pertemuan $pertemuan)
    {
        //
    }
}

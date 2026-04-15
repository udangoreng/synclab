<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dosen.dashboard');
    }

    /**
     * Manage Asisten - Show all asisten
     */
    public function manageAsisten()
    {
        $asistens = User::where('role', 'Asisten')->get();
        return view('dosen.manageAsisten', compact('asistens'));
    }

    /**
     * Store a newly created asisten
     */
    public function storeAsisten(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'nomor_induk' => $request->nomor_induk,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Asisten',
        ]);

        return redirect()->route('manageAsisten')->with('success', 'Asisten berhasil ditambahkan!');
    }

    /**
     * Update the specified asisten
     */
    public function updateAsisten(Request $request, $id)
    {
        $asisten = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255|unique:users,nomor_induk,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $asisten->update([
            'nama' => $request->nama,
            'nomor_induk' => $request->nomor_induk,
            'email' => $request->email,
        ]);

        // Update password if provided
        if ($request->password) {
            $asisten->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('manageAsisten')->with('success', 'Asisten berhasil diperbarui!');
    }

    /**
     * Remove the specified asisten
     */
    public function destroyAsisten($id)
    {
        $asisten = User::findOrFail($id);
        $asisten->delete();

        return redirect()->route('manageAsisten')->with('success', 'Asisten berhasil dihapus!');
    }

    /**
     * Manage Laboran - Show all laboran (Admin)
     */
    public function manageLaboran()
    {
        $laborans = User::where('role', 'Admin')->get();
        return view('dosen.manageLaboran', compact('laborans'));
    }

    /**
     * Store a newly created laboran
     */
    public function storeLaboran(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'nomor_induk' => $request->nomor_induk,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Admin', // Laboran menggunakan role Admin
        ]);

        return redirect()->route('manageLaboran')->with('success', 'Laboran berhasil ditambahkan!');
    }

    /**
     * Update the specified laboran
     */
    public function updateLaboran(Request $request, $id)
    {
        $laboran = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255|unique:users,nomor_induk,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $laboran->update([
            'nama' => $request->nama,
            'nomor_induk' => $request->nomor_induk,
            'email' => $request->email,
        ]);

        // Update password if provided
        if ($request->password) {
            $laboran->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('manageLaboran')->with('success', 'Laboran berhasil diperbarui!');
    }

    /**
     * Remove the specified laboran
     */
    public function destroyLaboran($id)
    {
        $laboran = User::findOrFail($id);
        $laboran->delete();

        return redirect()->route('manageLaboran')->with('success', 'Laboran berhasil dihapus!');
    }
}
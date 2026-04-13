<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    /**
     * Display a listing of presensi resource
     */
    public function index()
    {
        $user = Auth::user();

        try {
            if ($user->role === 'Praktikan') {
                $presensis = Presensi::where('id_user', $user->id)
                    ->with(['praktikum', 'user'])
                    ->get();

                // Jika ingin menampilkan view untuk praktikan
                return view('mahasiswa.presensi', compact('presensis'));
            } else {
                // Non-Praktikan melihat semua presensi
                $presensis = Presensi::with(['praktikum', 'user'])->get();
                
                return response()->json([
                    'success' => true,
                    'data' => $presensis
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching presensi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created presensi in storage
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.'
            ], 403);
        }

        $validated = $request->validate([
            'id_praktikum' => 'required|integer|exists:praktikums,id',
            'id_user' => 'required|integer|exists:users,id',
            'kehadiran' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'status' => 'sometimes|in:Dikonfirmasi,Pending,Ditolak',
        ]);

        try {
            $presensi = Presensi::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Presensi created successfully',
                'data' => $presensi->load('praktikum', 'user')
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified presensi in storage
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->role === 'Praktikan') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $presensi = Presensi::findOrFail($id);
            $validated = $request->validate([
                'id_praktikum' => 'sometimes|integer|exists:praktikums,id',
                'id_user' => 'sometimes|integer|exists:users,id',
                'kehadiran' => 'sometimes|in:Hadir,Izin,Sakit,Alpha',
                'status' => 'sometimes|in:Dikonfirmasi,Pending,Ditolak',
            ]);

            $presensi->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Presensi updated successfully',
                'data' => $presensi->load('praktikum', 'user')
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified presensi from storage
     */
    public function destroy($id)
    {
        if (Auth::user()->role === 'Praktikan') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            Presensi::findOrFail($id)->delete();
            return response()->json(['success' => true, 'message' => 'Deleted']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get presensi by Praktikum ID
     */
    public function getByPraktikum($idPraktikum)
    {
        $user = Auth::user();

        try {
            $query = Presensi::where('id_praktikum', $idPraktikum)->with(['praktikum', 'user']);

            if ($user->role === 'Praktikan') {
                $query->where('id_user', $user->id);
            }

            $presensis = $query->get();

            return response()->json([
                'success' => true,
                'data' => $presensis
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    /**
     * Display a listing of presensi resource
     * - Non-Praktikan (asisten, dosen, admin) dapat melihat semua presensi
     * - Praktikan hanya dapat melihat presensi miliknya sendiri
     */
    public function index()
    {
        $user = Auth::user();

        try {
            if ($user->role === 'Praktikan') {
                // Praktikan hanya melihat presensi mereka sendiri
                $presensis = Presensi::where('id_user', $user->id)
                    ->with('praktikum', 'user')
                    ->get();
            } else {
                // Non-Praktikan melihat semua presensi
                $presensis = Presensi::with('praktikum', 'user')->get();
            }

            return response()->json([
                'success' => true,
                'data' => $presensis
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching presensi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new presensi resource
     */
    public function create()
    {
        return response()->json([
            'message' => 'Show create form'
        ]);
    }

    /**
     * Store a newly created presensi in storage
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Only non-Praktikan can create presensi
        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can create presensi.'
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
            return response()->json([
                'success' => false,
                'message' => 'Error creating presensi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified presensi resource
     */
    public function show($id)
    {
        $user = Auth::user();

        try {
            $presensi = Presensi::with('praktikum', 'user')->findOrFail($id);

            // Check authorization
            if ($user->role === 'Praktikan' && $presensi->id_user !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized. You can only view your own presensi.'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => $presensi
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Presensi not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified presensi resource
     */
    public function edit($id)
    {
        $user = Auth::user();

        // Only non-Praktikan can edit presensi
        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can edit presensi.'
            ], 403);
        }

        try {
            $presensi = Presensi::findOrFail($id);
            return response()->json([
                'data' => $presensi
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Presensi not found'
            ], 404);
        }
    }

    /**
     * Update the specified presensi in storage
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Only non-Praktikan can update presensi
        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can update presensi.'
            ], 403);
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
                'data' => $presensi->load('pertemuan', 'user', 'praktikum')
            ]);raktikum', 'user
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Presensi not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating presensi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified presensi from storage
     */
    public function destroy($id)
    {
        $user = Auth::user();

        // Only non-Praktikan can delete presensi
        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can delete presensi.'
            ], 403);
        }

        try {
            $presensi = Presensi::findOrFail($id);
            $presensi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Presensi deleted successfully'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Presensi not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting presensi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get presensi by pertemuan
     */raktikum
     */
    public function getByPraktikum($idPraktikum)
    {
        $user = Auth::user();

        try {
            if ($user->role === 'Praktikan') {
                $presensis = Presensi::where('id_praktikum', $idPraktikum)
                    ->where('id_user', $user->id)
                    ->with('praktikum', 'user')
                    ->get();
            } else {
                $presensis = Presensi::where('id_praktikum', $idPraktikum)
                    ->with('praktikum', 'user
            }

            return response()->json([
                'success' => true,
                'data' => $presensis
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching presensi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get presensi by user
     */praktikum
     */
    public function getByPraktikum($idPraktikum)
    {
        $user = Auth::user();

        try {
            if ($user->role === 'Praktikan') {
                $presensis = Presensi::where('id_praktikum', $idPraktikum)
                    ->where('id_user', $user->id)
                    ->with('praktikum', 'user')
                    ->get();
            } else {
                $presensis = Presensi::where('id_praktikum', $idPraktikum)
                    ->with('praktikum', 'user')
                    ->get();
            }
            return response()->json([
                'success' => true,
                'data' => $presensis
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching presensi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get presensi by pertemuan and praktikum
     */
    public function getBraktikum
     */
    public function getByPraktikum($idPraktikum)
    {
        $user = Auth::user();

        try {
            if ($user->role === 'Praktikan') {
                $presensis = Presensi::where('id_praktikum', $idPraktikum)
                    ->where('id_user', $user->id)
                    ->with('praktikum', 'user')
                    ->get();
            } else {
                $presensis = Presensi::where('id_praktikum', $idPraktikum)
                    ->with('praktikum', 'user

            return response()->json([
                'success' => true,
                'data' => $presensis
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching presensi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

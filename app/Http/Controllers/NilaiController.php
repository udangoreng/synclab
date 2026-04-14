<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Display a listing of nilai resource
     * - Non-Praktikan (asisten, dosen, admin) dapat melihat semua nilai
     * - Praktikan hanya dapat melihat nilai miliknya sendiri
     */
    public function index()
    {
        $user = Auth::user();

        try {
            if ($user->role === 'Praktikan') {
                $nilais = Nilai::where('id_user', $user->id)
                    ->with('praktikum', 'user')
                    ->get();

                //show 
                return view('mahasiswa/nilai', compact('nilais', 'user'));
            } else {
                $nilais = Nilai::with('praktikum', 'user')->get();

                if ($user->role === 'Dosen') {
                    return view('dosen/validasinilai', compact('nilais', 'user'));
                } elseif ($user->role === 'Asisten') {
                    return view('asisten/nilai_asisten', compact('nilais', 'user'));
                }
            }

            return response()->json([
                'success' => true,
                'data' => $nilais
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching nilai',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function rekapNilai()
    {
        return view('asisten/rekapNilai_asisten');
    }

    /**
     * Show the form for creating a new nilai resource
     */
    public function create()
    {
        return response()->json([
            'message' => 'Show create form'
        ]);
    }

    /**
     * Store a newly created nilai in storage
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Only non-Praktikan can create nilai
        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can create nilai.'
            ], 403);
        }

        $validated = $request->validate([
            'id_praktikum' => 'required|integer|exists:praktikums,id',
            'id_user' => 'required|integer|exists:users,id',
            'nilai_pretest' => 'sometimes|integer|min:0|max:100',
            'nilai_laporan' => 'sometimes|integer|min:0|max:100',
            'nilai_total' => 'sometimes|integer|min:0|max:100',
            'nilai_akhir' => 'sometimes|integer|min:0|max:100',
            'komentar' => 'sometimes|string',
            'status' => 'sometimes|in:Pending,Terkonfirmasi',
        ]);

        try {
            $nilai = Nilai::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Nilai created successfully',
                'data' => $nilai->load('praktikum', 'user')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating nilai',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified nilai resource
     */
    public function show($id)
    {
        $user = Auth::user();

        try {
            $nilai = Nilai::with('praktikum', 'user')->findOrFail($id);

            // Check authorization
            if ($user->role === 'Praktikan' && $nilai->id_user !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized. You can only view your own nilai.'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => $nilai
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified nilai resource
     */
    public function edit($id)
    {
        $user = Auth::user();

        // Only non-Praktikan can edit nilai
        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can edit nilai.'
            ], 403);
        }

        try {
            $nilai = Nilai::findOrFail($id);
            return response()->json([
                'data' => $nilai
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai not found'
            ], 404);
        }
    }

    /**
     * Update the specified nilai in storage
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Only non-Praktikan can update nilai
        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can update nilai.'
            ], 403);
        }

        try {
            $nilai = Nilai::findOrFail($id);

            $validated = $request->validate([
                'id_praktikum' => 'sometimes|integer|exists:praktikums,id',
                'id_user' => 'sometimes|integer|exists:users,id',
                'nilai_pretest' => 'sometimes|integer|min:0|max:100',
                'nilai_laporan' => 'sometimes|integer|min:0|max:100',
                'nilai_total' => 'sometimes|integer|min:0|max:100',
                'nilai_akhir' => 'sometimes|integer|min:0|max:100',
                'komentar' => 'sometimes|string',
                'status' => 'sometimes|in:Pending,Terkonfirmasi',
            ]);

            $nilai->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Nilai updated successfully',
                'data' => $nilai->load('praktikum', 'user', 'pertemuan')
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating nilai',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified nilai from storage
     */
    public function destroy($id)
    {
        $user = Auth::user();

        // Only non-Praktikan can delete nilai
        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can delete nilai.'
            ], 403);
        }

        try {
            $nilai = Nilai::findOrFail($id);
            $nilai->delete();

            return response()->json([
                'success' => true,
                'message' => 'Nilai deleted successfully'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting nilai',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get nilai by praktikum and pertemuan
     */

    public function getByPraktikum($idPraktikum)
    {
        $user = Auth::user();

        try {
            if ($user->role === 'Praktikan') {
                $nilais = Nilai::where('id_praktikum', $idPraktikum)
                    ->where('id_user', $user->id)
                    ->with('praktikum', 'user')
                    ->get();
            } else {
                $nilais = Nilai::where('id_praktikum', $idPraktikum)
                    ->with('praktikum', 'user');
            }

            return response()->json([
                'success' => true,
                'data' => $nilais
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching nilai',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get nilai by user
     */
    public function getByUser($userId)
    {
        $user = Auth::user();

        // Praktikan hanya bisa melihat nilai mereka sendiri
        if ($user->role === 'Praktikan' && $user->id !== (int)$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. You can only view your own nilai.'
            ], 403);
        }

        try {
            $nilais = Nilai::where('id_user', $userId)
                ->with('praktikum', 'user', 'pertemuan')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $nilais
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching nilai',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

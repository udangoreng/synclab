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
                // Get presensi with pertemuan -> praktikum
                $presensis = Presensi::where('id_user', $user->id)
                    ->with(['pertemuan.praktikum', 'user'])
                    ->get();

                // Group by praktikum for summary
                $presensiPerPraktikum = $presensis->groupBy(function($presensi) {
                    return $presensi->pertemuan?->praktikum?->nama_praktikum ?? 'Unknown';
                });

                return view('mahasiswa/presensi', compact('presensis', 'presensiPerPraktikum'));
            }

            $presensis = Presensi::with('pertemuan.praktikum', 'user')->get();

            if ($user->role === 'Dosen') {
                return view('dosen/presensi', compact('presensis'));
            } elseif ($user->role === 'Asisten') {
                return view('asisten/presensiSatu_asisten', compact('presensis'));
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

    public function getHistoryPresensi() {
        $presensis = Presensi::with('pertemuan.praktikum', 'user')->get();
        return view('asisten/presensiDua_asisten', compact('presensis'));
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
            'id_pertemuan' => 'required|integer|exists:pertemuans,id',
            'id_user' => 'required|integer|exists:users,id',
            'kehadiran' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'status' => 'sometimes|in:Dikonfirmasi,Pending,Ditolak',
        ]);

        try {
            $presensi = Presensi::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Presensi created successfully',
                'data' => $presensi->load('pertemuan', 'user')
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
                'id_pertemuan' => 'sometimes|integer|exists:pertemuans,id',
                'id_user' => 'sometimes|integer|exists:users,id',
                'kehadiran' => 'sometimes|in:Hadir,Izin,Sakit,Alpha',
                'status' => 'sometimes|in:Dikonfirmasi,Pending,Ditolak',
            ]);

            $presensi->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Presensi updated successfully',
                'data' => $presensi->load('pertemuan.praktikum', 'user')
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Presensi not found'
            ], 404);
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
     * Get presensi by pertemuan
     *
     */
    public function getByPraktikum($idPraktikum)
    {
        $user = Auth::user();

        try {
            $query = Presensi::whereHas('pertemuan', function($q) use ($idPraktikum) {
                $q->where('id_praktikum', $idPraktikum);
            })->with(['pertemuan.praktikum', 'user']);

            if ($user->role === 'Praktikan') {
                $presensis = $query->where('id_user', $user->id)->get();
            } else {
                $presensis = $query->get();
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
     *
     */
    public function getByPraktikumUser($idPraktikum)
    {
        $user = Auth::user();

        try {
            $query = Presensi::whereHas('pertemuan', function($q) use ($idPraktikum) {
                $q->where('id_praktikum', $idPraktikum);
            })->with(['pertemuan.praktikum', 'user']);

            if ($user->role === 'Praktikan') {
                $presensis = $query->where('id_user', $user->id)->get();
            } else {
                $presensis = $query->get();
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
    public function getByPraktikumPertemuan($idPraktikum)
    {
        $user = Auth::user();

        try {
            $query = Presensi::whereHas('pertemuan', function($q) use ($idPraktikum) {
                $q->where('id_praktikum', $idPraktikum);
            })->with(['pertemuan.praktikum', 'user']);

            if ($user->role === 'Praktikan') {
                $presensis = $query->where('id_user', $user->id)->get();
            } else {
                $presensis = $query->get();
            }

            return response()->json([
                'success' => true,
                'data' => $presensis
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}

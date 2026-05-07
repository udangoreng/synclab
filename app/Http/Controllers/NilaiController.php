<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        try {
            if ($user->role === 'Dosen') {
    $nilais = Nilai::with(['pertemuan.praktikum', 'user'])
        ->orderBy('created_at', 'desc')
        ->paginate(20);
    
    // Transform data untuk view
    $nilaiData = $nilais->through(function ($nilai) {
        return [
            'id' => $nilai->id,
            'nama' => optional($nilai->user)->nama ?? '-',
            'nim' => optional($nilai->user)->nomor_induk ?? '-',
            'matkul' => optional($nilai->pertemuan?->praktikum)->nama_praktikum ?? '-',
            'kelas' => optional($nilai->user)->angkatan ?? '-',
            'pretest' => $nilai->nilai_pretest ?? 0,
            'laporan' => $nilai->nilai_laporan ?? 0,
            'nilai_akhir' => $nilai->nilai_akhir ?? 0,
            'validated' => $nilai->status === 'Tervalidasi',
            'status' => $nilai->status ?? 'Pending',
        ];
    });
    
    $praktikums = \App\Models\Praktikum::all();
    
    return view('dosen.validasinilai', [
        'nilais' => $nilaiData,
        'praktikums' => $praktikums,
        'filterPraktikum' => 'all',
        'filterStatus' => 'all',
        'user' => $user
    ]);
            } else {
                $nilais = Nilai::with('pertemuan.praktikum', 'user')->get();

                if ($user->role === 'Dosen') {
                    $nilaiData = $nilais->map(function ($nilai) {
                        return [
                            'id'        => $nilai->id,
                            'nama'      => optional($nilai->user)->nama ?? '-',
                            'nim'       => optional($nilai->user)->nomor_induk ?? '-',
                            'matkul'    => optional($nilai->pertemuan?->praktikum)->nama_praktikum
                                            ?? optional($nilai->pertemuan)->nama_pertemuan ?? '-',
                            'kelas'     => optional($nilai->user)->kelas ?? '-',
                            'pretest'   => $nilai->nilai_pretest,
                            'laporan'   => $nilai->nilai_laporan,
                            'validated' => $nilai->status === 'Terkonfirmasi',
                            'status'    => $nilai->status,
                        ];
                    });

                    return view('dosen/validasinilai', ['nilais' => $nilaiData, 'user' => $user]);

                } elseif ($user->role === 'Asisten') {
                    return view('asisten/nilai_asisten', compact('nilais', 'user'));
                }
            }

            return response()->json(['success' => true, 'data' => $nilais]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching nilai',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function rekapNilai()
    {
        return view('asisten/rekapNilai_asisten');
    }

    public function create()
    {
        return response()->json(['message' => 'Show create form']);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can create nilai.'
            ], 403);
        }

        $validated = $request->validate([
            'id_pertemuan'  => 'required|integer|exists:pertemuans,id',
            'id_user'       => 'required|integer|exists:users,id',
            'nilai_pretest' => 'sometimes|integer|min:0|max:100',
            'nilai_laporan' => 'sometimes|integer|min:0|max:100',
            'nilai_total'   => 'sometimes|integer|min:0|max:100',
            'nilai_akhir'   => 'sometimes|integer|min:0|max:100',
            'komentar'      => 'sometimes|string',
            'status'        => 'sometimes|in:Pending,Terkonfirmasi',
        ]);

        try {
            $nilai = Nilai::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Nilai created successfully',
                'data'    => $nilai->load('pertemuan.praktikum', 'user')
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating nilai',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $user = Auth::user();

        try {
            $nilai = Nilai::with('pertemuan.praktikum', 'user')->findOrFail($id);

            if ($user->role === 'Praktikan' && $nilai->id_user !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized. You can only view your own nilai.'
                ], 403);
            }

            return response()->json(['success' => true, 'data' => $nilai]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Nilai not found'], 404);
        }
    }

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can edit nilai.'
            ], 403);
        }

        try {
            $nilai = Nilai::findOrFail($id);
            return response()->json(['data' => $nilai]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Nilai not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can update nilai.'
            ], 403);
        }

        try {
            $nilai = Nilai::findOrFail($id);

            $validated = $request->validate([
                'id_pertemuan'  => 'sometimes|integer|exists:pertemuans,id',
                'id_user'       => 'sometimes|integer|exists:users,id',
                'nilai_pretest' => 'sometimes|integer|min:0|max:100',
                'nilai_laporan' => 'sometimes|integer|min:0|max:100',
                'nilai_total'   => 'sometimes|integer|min:0|max:100',
                'nilai_akhir'   => 'sometimes|integer|min:0|max:100',
                'komentar'      => 'sometimes|string',
                'status'        => 'sometimes|in:Pending,Terkonfirmasi',
            ]);

            $nilai->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Nilai updated successfully',
                'data'    => $nilai->load('pertemuan.praktikum', 'user')
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Nilai not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating nilai',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->role === 'Praktikan') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Only asisten, dosen, or admin can delete nilai.'
            ], 403);
        }

        try {
            $nilai = Nilai::findOrFail($id);
            $nilai->delete();

            return response()->json(['success' => true, 'message' => 'Nilai deleted successfully']);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Nilai not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting nilai',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function getByPraktikum($idPraktikum)
    {
        $user = Auth::user();

        try {
            $query = Nilai::whereHas('pertemuan', function ($q) use ($idPraktikum) {
                    $q->where('id_praktikum', $idPraktikum);
                })
                ->with('pertemuan.praktikum', 'user');

            if ($user->role === 'Praktikan') {
                $query->where('id_user', $user->id);
            }

            $nilais = $query->get();

            return response()->json(['success' => true, 'data' => $nilais]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching nilai',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function getByUser($userId)
    {
        $user = Auth::user();

        if ($user->role === 'Praktikan' && $user->id !== (int) $userId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. You can only view your own nilai.'
            ], 403);
        }

        try {
            $nilais = Nilai::where('id_user', $userId)
                ->with('pertemuan.praktikum', 'user')
                ->get();

            return response()->json(['success' => true, 'data' => $nilais]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching nilai',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function masterNilai(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $query = Nilai::with(['pertemuan.praktikum', 'pertemuan.modul', 'user']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('nomor_induk', 'like', "%{$search}%");
                })->orWhereHas('pertemuan', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%{$search}%");
                });
            });
        }

        if ($status && in_array($status, ['Pending', 'Terkonfirmasi'])) {
            $query->where('status', $status);
        }

        $nilais = $query->orderBy('created_at', 'desc')->paginate(10);

        $statistics = [
            'rata_rata_nilai_akhir' => number_format(Nilai::avg('nilai_akhir') ?? 0, 2),
            'nilai_tertinggi'       => Nilai::max('nilai_akhir') ?? 0,
            'nilai_terendah'        => Nilai::min('nilai_akhir') ?? 0,
            'total_mahasiswa'       => Nilai::distinct('id_user')->count('id_user'),
            'total_terkonfirmasi'   => Nilai::where('status', 'Terkonfirmasi')->count(),
            'total_pending'         => Nilai::where('status', 'Pending')->count(),
        ];

        return view('laboran.kelolaNilai', compact('nilais', 'statistics'));
    }
}
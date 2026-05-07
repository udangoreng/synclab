<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Praktikum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Display a listing of nilai resource
     * - Non-Praktikan (asisten, dosen, admin) dapat melihat semua nilai
     * - Praktikan hanya dapat melihat nilai miliknya sendiri
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        try {
            if ($user->role === 'Praktikan') {
                $nilais = Nilai::where('id_user', $user->id)
                    ->with('pertemuan.jadwal.praktikum', 'user')
                    ->get();

                return view('mahasiswa/nilai', compact('nilais', 'user'));

            } else {
                // For Asisten - get only students in their praktikums
                if ($user->role === 'Asisten') {
                    // Get jadwal IDs where user is Asisten
                    $jadwalIds = DB::table('pendaftaran_praktikum')
                        ->where('id_user', $user->id)
                        ->where('role', 'Asisten')
                        ->pluck('id_jadwal')
                        ->toArray();

                    // Get praktikum IDs from those jadwals
                    $praktikumIds = DB::table('jadwals')
                        ->whereIn('id', $jadwalIds)
                        ->pluck('id_praktikum')
                        ->unique()
                        ->toArray();

                    // Get all pertemuan IDs for those praktikums
                    $pertemuanIds = Pertemuan::whereHas('jadwal', function ($q) use ($praktikumIds) {
                        $q->whereIn('id_praktikum', $praktikumIds);
                    })->pluck('id')->toArray();

                    // Get all students (Praktikan) registered
                    $studentIds = DB::table('pendaftaran_praktikum')
                        ->whereIn('id_jadwal', $jadwalIds)
                        ->where('role', 'Praktikan')
                        ->pluck('id_user')
                        ->unique()
                        ->toArray();

                    $query = Nilai::with(['pertemuan.jadwal.praktikum', 'user'])
                        ->whereIn('id_user', $studentIds)
                        ->whereIn('id_pertemuan', $pertemuanIds);

                    // Apply filters
                    if ($request->has('matkul') && $request->matkul) {
                        $query->whereHas('pertemuan.jadwal.praktikum', function ($q) use ($request) {
                            $q->where('nama_praktikum', $request->matkul);
                        });
                    }

                    if ($request->has('praktikum') && $request->praktikum) {
                        $query->whereHas('pertemuan.jadwal.praktikum', function ($q) use ($request) {
                            $q->where('nama_praktikum', $request->praktikum);
                        });
                    }

                    if ($request->has('pertemuan_id') && $request->pertemuan_id) {
                        $query->where('id_pertemuan', $request->pertemuan_id);
                    }

                    if ($request->has('search') && $request->search) {
                        $search = $request->search;
                        $query->where(function ($q) use ($search) {
                            $q->whereHas('user', function ($sub) use ($search) {
                                $sub->where('nama', 'like', "%{$search}%")
                                    ->orWhere('nomor_induk', 'like', "%{$search}%");
                            });
                        });
                    }

                    $nilais = $query->orderBy('created_at', 'desc')->paginate(15);

                    // Get filter options
                    $praktikums = Praktikum::whereIn('id', $praktikumIds)->get();
                    $praktikumNames = $praktikums->pluck('nama_praktikum')->unique()->values();
                    $pertemuans = Pertemuan::whereIn('id', $pertemuanIds)
                        ->orderBy('pertemuan_ke', 'asc')
                        ->get();

                    return view('asisten/nilai_asisten', compact('nilais', 'praktikumNames', 'pertemuans', 'user'));
                } elseif ($user->role === 'Dosen') {
                    $nilais = Nilai::with('pertemuan.jadwal.praktikum', 'user')->get();
                    return view('dosen/validasinilai', compact('nilais', 'user'));
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

    /**
     * Update multiple nilai records at once
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'nilai_updates' => 'required|array',
            'nilai_updates.*.id' => 'required|exists:nilais,id',
            'nilai_updates.*.nilai_pretest' => 'nullable|integer|min:0|max:100',
            'nilai_updates.*.nilai_laporan' => 'nullable|integer|min:0|max:100',
        ]);

        try {
            $updatedCount = 0;
            foreach ($request->nilai_updates as $update) {
                $nilai = Nilai::find($update['id']);
                if ($nilai) {
                    $nilaiPretest = $update['nilai_pretest'] ?? $nilai->nilai_pretest;
                    $nilaiLaporan = $update['nilai_laporan'] ?? $nilai->nilai_laporan;

                    // Calculate nilai_total (average of pretest and laporan)
                    $nilaiTotal = round(($nilaiPretest + $nilaiLaporan) / 2);

                    // Calculate nilai_akhir (could be same as total or different logic)
                    $nilaiAkhir = $nilaiTotal;

                    $nilai->update([
                        'nilai_pretest' => $nilaiPretest,
                        'nilai_laporan' => $nilaiLaporan,
                        'nilai_total' => $nilaiTotal,
                        'nilai_akhir' => $nilaiAkhir,
                        'status' => 'Terkonfirmasi'
                    ]);
                    $updatedCount++;
                }
            }

            return redirect()->route('addNilai')->with('success', "{$updatedCount} nilai berhasil disimpan!");
        } catch (\Exception $e) {
            return redirect()->route('addNilai')->with('error', 'Gagal menyimpan nilai: ' . $e->getMessage());
        }
    }

    public function rekapNilai(Request $request)
    {
        $user = Auth::user();
        
        // Get jadwal IDs where user is Asisten
        $jadwalIds = DB::table('pendaftaran_praktikum')
            ->where('id_user', $user->id)
            ->where('role', 'Asisten')
            ->pluck('id_jadwal')
            ->toArray();
        
        // Get praktikum IDs from those jadwals
        $praktikumIds = DB::table('jadwals')
            ->whereIn('id', $jadwalIds)
            ->pluck('id_praktikum')
            ->unique()
            ->toArray();
        
        // Get all pertemuan IDs for those praktikums
        $pertemuanIds = Pertemuan::whereHas('jadwal', function($q) use ($praktikumIds) {
            $q->whereIn('id_praktikum', $praktikumIds);
        })->pluck('id')->toArray();
        
        // Get all students (Praktikan) registered
        $studentIds = DB::table('pendaftaran_praktikum')
            ->whereIn('id_jadwal', $jadwalIds)
            ->where('role', 'Praktikan')
            ->pluck('id_user')
            ->unique()
            ->toArray();
        
        $query = Nilai::with(['pertemuan.jadwal.praktikum', 'user'])
            ->whereIn('id_user', $studentIds)
            ->whereIn('id_pertemuan', $pertemuanIds);
        
        // Apply filters
        if ($request->has('matkul') && $request->matkul) {
            $query->whereHas('pertemuan.jadwal.praktikum', function($q) use ($request) {
                $q->where('nama_praktikum', $request->matkul);
            });
        }
        
        if ($request->has('praktikum') && $request->praktikum) {
            $query->whereHas('pertemuan.jadwal.praktikum', function($q) use ($request) {
                $q->where('nama_praktikum', $request->praktikum);
            });
        }
        
        if ($request->has('pertemuan_id') && $request->pertemuan_id) {
            $query->where('id_pertemuan', $request->pertemuan_id);
        }
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($sub) use ($search) {
                    $sub->where('nama', 'like', "%{$search}%")
                        ->orWhere('nomor_induk', 'like', "%{$search}%");
                });
            });
        }
        
        $nilais = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Calculate grade for each nilai
        foreach ($nilais as $nilai) {
            $nilai->grade = $this->calculateGrade($nilai->nilai_akhir);
        }
        
        // Get filter options
        $praktikums = Praktikum::whereIn('id', $praktikumIds)->get();
        $praktikumNames = $praktikums->pluck('nama_praktikum')->unique()->values();
        $pertemuans = Pertemuan::whereIn('id', $pertemuanIds)
            ->orderBy('pertemuan_ke', 'asc')
            ->get();
        
        return view('asisten/rekapNilai_asisten', compact('nilais', 'praktikumNames', 'pertemuans', 'user'));
    }
    
    private function calculateGrade($nilai)
    {
        if ($nilai === null) return '-';
        
        if ($nilai >= 85) return 'A';
        if ($nilai >= 80) return 'A-';
        if ($nilai >= 75) return 'B+';
        if ($nilai >= 70) return 'B';
        if ($nilai >= 65) return 'B-';
        if ($nilai >= 60) return 'C+';
        if ($nilai >= 55) return 'C';
        if ($nilai >= 50) return 'D';
        return 'E';
    }

    /**
     * Update single nilai record
     */
    public function updateNilai(Request $request, $id)
    {
        $request->validate([
            'nilai_pretest' => 'nullable|integer|min:0|max:100',
            'nilai_laporan' => 'nullable|integer|min:0|max:100',
        ]);

        try {
            $nilai = Nilai::findOrFail($id);

            $nilaiPretest = $request->nilai_pretest ?? $nilai->nilai_pretest;
            $nilaiLaporan = $request->nilai_laporan ?? $nilai->nilai_laporan;

            // Calculate nilai_total (average of pretest and laporan)
            $nilaiTotal = round(($nilaiPretest + $nilaiLaporan) / 2);
            $nilaiAkhir = $nilaiTotal;

            $nilai->update([
                'nilai_pretest' => $nilaiPretest,
                'nilai_laporan' => $nilaiLaporan,
                'nilai_total' => $nilaiTotal,
                'nilai_akhir' => $nilaiAkhir,
                'status' => 'Terkonfirmasi'
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Nilai berhasil disimpan',
                    'data' => $nilai
                ]);
            }

            return redirect()->route('addNilai')->with('success', 'Nilai berhasil disimpan!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan nilai: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->route('addNilai')->with('error', 'Gagal menyimpan nilai: ' . $e->getMessage());
        }
    }

    /**
     * Delete nilai record
     */
    public function destroyNilai($id)
    {
        try {
            $nilai = Nilai::findOrFail($id);
            $nilai->delete();

            return redirect()->route('addNilai')->with('success', 'Nilai berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('addNilai')->with('error', 'Gagal menghapus nilai: ' . $e->getMessage());
        }
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

        // Query using Eloquent Model (Nilai)
        $query = Nilai::with(['pertemuan.modul', 'user']);

        // Apply search filter
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

        // Apply status filter
        if ($status && in_array($status, ['Pending', 'Terkonfirmasi'])) {
            $query->where('status', $status);
        }

        // Order by latest
        $nilais = $query->orderBy('created_at', 'desc')->paginate(10);

        // Calculate statistics
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

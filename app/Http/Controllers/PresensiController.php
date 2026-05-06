<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Praktikum;
use App\Models\Pertemuan;
use App\Models\User;

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
                // Get presensi with pertemuan -> jadwal -> praktikum
                $presensis = Presensi::where('id_user', $user->id)
                    ->with(['pertemuan.jadwal.praktikum', 'user'])
                    ->paginate(25)->get();

                // Group by praktikum for summary
                $presensiPerPraktikum = $presensis->groupBy(function ($presensi) {
                    return $presensi->pertemuan?->praktikum?->nama_praktikum ?? 'Unknown';
                });

                return view('mahasiswa/presensi', compact('presensis', 'presensiPerPraktikum'));
            } else {
                $presensis = Presensi::with('pertemuan.jadwal.praktikum', 'user')->get();

                if ($user->role === 'Dosen') {
                    return view('dosen/presensi', compact('presensis'));
                } elseif ($user->role === 'Asisten') {
                    $user = Auth::user();

                    $praktikumIds = DB::table('pendaftaran_praktikum')
                        ->where('id_user', $user->id)
                        ->where('role', 'Asisten')
                        ->pluck('id_jadwal')
                        ->toArray();

                    $praktikums = Praktikum::whereIn('id', $praktikumIds)
                        ->with(['jadwals.pertemuan'])
                        ->get();

                    $praktikumList = [];
                    $counter = 1;

                    foreach ($praktikums as $praktikum) {
                        foreach ($praktikum->jadwals as $jadwal) {
                            if ($jadwal->pertemuan && $jadwal->pertemuan->isNotEmpty()) {
                                foreach ($jadwal->pertemuan as $pertemuan) {
                                    $praktikumList[] = [
                                        'no'              => $counter++,
                                        'id'              => $praktikum->id,
                                        'kode_praktikum'  => $praktikum->kode_praktikum,
                                        'nama_praktikum'  => $praktikum->nama_praktikum,
                                        'pertemuan_id'    => $pertemuan->id,
                                        'pertemuan_ke'    => $pertemuan->pertemuan_ke,
                                        'nama_pertemuan'  => $pertemuan->nama_pertemuan,
                                        'jadwal_id'       => $jadwal->id,
                                        'hari'            => $jadwal->hari,
                                        'jam_mulai'       => $jadwal->jam_mulai,
                                        'jam_selesai'     => $jadwal->jam_selesai,
                                    ];
                                }
                            }
                        }
                    }

                    return view('Asisten.presensiSatu_asisten', compact('praktikumList'));
                }
            }

            if ($user->role === 'Dosen') {
                return view('dosen/presensi', compact('presensis'));
            } elseif ($user->role === 'Asisten') {
                $user = Auth::user();

                $jadwalIds = DB::table('pendaftaran_praktikum')
                    ->where('id_user', $user->id)
                    ->where('role', 'Asisten')
                    ->whereIn('status', ['Dikonfirmasi', 'Pending'])
                    ->pluck('id_jadwal')
                    ->toArray();

                $praktikumIds = DB::table('jadwals')
                    ->whereIn('id', $jadwalIds)
                    ->pluck('id_praktikum')
                    ->unique()
                    ->toArray();

                $praktikums = Praktikum::whereIn('id', $praktikumIds)
                    ->with(['jadwals.pertemuan'])
                    ->get();

                $praktikumList = [];
                $counter = 1;

                foreach ($praktikums as $praktikum) {
                    foreach ($praktikum->jadwals as $jadwal) {
                        if ($jadwal->pertemuan && $jadwal->pertemuan->isNotEmpty()) {
                            foreach ($jadwal->pertemuan as $pertemuan) {
                                $praktikumList[] = [
                                    'no'             => $counter++,
                                    'id'             => $praktikum->id,
                                    'kode_praktikum' => $praktikum->kode_praktikum,
                                    'nama_praktikum' => $praktikum->nama_praktikum,
                                    'pertemuan_id'   => $pertemuan->id,
                                    'pertemuan_ke'   => $pertemuan->pertemuan_ke,
                                    'nama_pertemuan' => $pertemuan->nama_pertemuan,
                                    'jadwal_id'      => $jadwal->id,
                                    'hari'           => $jadwal->hari,
                                    'jam_mulai'      => $jadwal->jam_mulai,
                                    'jam_selesai'    => $jadwal->jam_selesai,
                                ];
                            }
                        }
                    }
                }

                return view('Asisten.presensiSatu_asisten', compact('praktikumList'));
            }

            // return response()->json([
            //     'success' => true,
            //     'data' => $presensis
            // ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching presensi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function recordAttendance(Request $request)
    {
        $pertemuanId = $request->get('pertemuan_id');
        $praktikumId = $request->get('praktikum_id');
        $user = Auth::user();

        $hasAccess = DB::table('pendaftaran_praktikum')
            ->where('id_user', $user->id)
            ->where('id_praktikum', $praktikumId)
            ->where('role', 'Asisten')
            ->exists();

        if (!$hasAccess) {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $pertemuan = Pertemuan::with(['jadwal.praktikum', 'jadwal.laboratorium'])
            ->where('id', $pertemuanId)
            ->firstOrFail();


        $praktikanIds = DB::table('pendaftaran_praktikum')
            ->where('id_praktikum', $praktikumId)
            ->where('role', 'Praktikan')
            ->pluck('id_user')
            ->toArray();

        $mahasiswas = User::whereIn('id', $praktikanIds)
            ->select('id', 'nomor_induk', 'nama')
            ->orderBy('nama')
            ->get();

        $existingPresensi = Presensi::where('id_pertemuan', $pertemuanId)
            ->get()
            ->keyBy('id_user');

        $attendanceData = [];
        foreach ($mahasiswas as $mahasiswa) {
            $presensi = $existingPresensi->get($mahasiswa->id);
            $attendanceData[] = [
                'user_id' => $mahasiswa->id,
                'nim' => $mahasiswa->nomor_induk,
                'nama' => $mahasiswa->nama,
                'status' => $presensi ? $presensi->kehadiran : null,
            ];
        }

        return view('asisten.presensi_asisten', compact('pertemuan', 'attendanceData', 'praktikumId'));
    }

    public function saveAttendance(Request $request)
    {
        $request->validate([
            'pertemuan_id' => 'required|exists:pertemuans,id',
            'praktikum_id' => 'required|exists:praktikums,id',
            'attendance' => 'required|array',
        ]);

        $user = Auth::user();

        $hasAccess = DB::table('pendaftaran_praktikum')
            ->where('id_user', $user->id)
            ->where('id_praktikum', $request->praktikum_id)
            ->where('role', 'Asisten')
            ->exists();

        if (!$hasAccess) {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $savedCount = 0;
        $updatedCount = 0;

        foreach ($request->attendance as $userId => $status) {
            if ($status && in_array($status, ['Hadir', 'Izin', 'Sakit', 'Alpha'])) {
                $existing = Presensi::where('id_user', $userId)
                    ->where('id_pertemuan', $request->pertemuan_id)
                    ->first();

                if ($existing) {
                    $existing->update([
                        'kehadiran' => $status,
                        'status' => 'Dikonfirmasi',
                    ]);
                    $updatedCount++;
                } else {
                    Presensi::create([
                        'id_user' => $userId,
                        'id_pertemuan' => $request->pertemuan_id,
                        'kehadiran' => $status,
                        'status' => 'Dikonfirmasi',
                    ]);
                    $savedCount++;
                }
            }
        }

        return redirect()->route('konfirmasiPresensi')
            ->with('success', "Presensi berhasil disimpan! {$savedCount} data baru, {$updatedCount} data diperbarui.");
    }

    public function getHistoryPresensi()
    {
        $user = Auth::user();

        // STEP 1: jadwal ids milik asisten ini
        $jadwalIds = DB::table('pendaftaran_praktikum')
            ->where('id_user', $user->id)
            ->where('role', 'Asisten')
            ->pluck('id_jadwal')
            ->toArray();

        // STEP 2: praktikum ids via jadwals (untuk whereHas di bawah)
        $praktikumIds = DB::table('jadwals')
            ->whereIn('id', $jadwalIds)
            ->pluck('id_praktikum')
            ->unique()
            ->toArray();

        $pertemuans = Pertemuan::with(['jadwal.praktikum', 'presensi'])
            ->whereHas('jadwal', function ($query) use ($praktikumIds) {
                $query->whereIn('id_praktikum', $praktikumIds);
            })
            ->orderBy('pertemuan_ke')
            ->get();

        $groupedPertemuans = [];
        foreach ($pertemuans as $pertemuan) {
            $praktikumName = $pertemuan->jadwal->praktikum->nama_praktikum;
            $praktikumCode = $pertemuan->jadwal->praktikum->kode_praktikum;
            $praktikumId   = $pertemuan->jadwal->praktikum->id;

            if (!isset($groupedPertemuans[$praktikumName])) {
                $groupedPertemuans[$praktikumName] = [
                    'id_praktikum'   => $praktikumId,
                    'kode_praktikum' => $praktikumCode,
                    'nama_praktikum' => $praktikumName,
                    'pertemuans'     => [],
                ];
            }

            $groupedPertemuans[$praktikumName]['pertemuans'][] = [
                'id'             => $pertemuan->id,
                'pertemuan_ke'   => $pertemuan->pertemuan_ke,
                'nama_pertemuan' => $pertemuan->nama_pertemuan,
                'hari'           => $pertemuan->jadwal->hari,
                'jam_mulai'      => $pertemuan->jadwal->jam_mulai,
                'jam_selesai'    => $pertemuan->jadwal->jam_selesai,
                'tanggal'        => $pertemuan->created_at,
                'total_presensi' => $pertemuan->presensi->count(),
                'hadir'          => $pertemuan->presensi->where('kehadiran', 'Hadir')->count(),
                'izin'           => $pertemuan->presensi->where('kehadiran', 'Izin')->count(),
                'sakit'          => $pertemuan->presensi->where('kehadiran', 'Sakit')->count(),
                'alpha'          => $pertemuan->presensi->where('kehadiran', 'Alpha')->count(),
            ];
        }

        return view('asisten.presensiDua_asisten', compact('groupedPertemuans'));
    }

    public function viewAttendanceDetail(Request $request)
    {
        $pertemuanId = $request->get('pertemuan_id');
        $praktikumId = $request->get('praktikum_id');
        $user = Auth::user();

        $hasAccess = DB::table('pendaftaran_praktikum')
            ->where('id_user', $user->id)
            ->where('id_praktikum', $praktikumId)
            ->where('role', 'Asisten')
            ->exists();

        if (!$hasAccess) {
            return redirect()->route('riwayatPresensi')
                ->with('error', 'Akses ditolak');
        }

        $pertemuan = Pertemuan::with(['jadwal.praktikum', 'jadwal.laboratorium'])
            ->where('id', $pertemuanId)
            ->firstOrFail();

        $praktikanIds = DB::table('pendaftaran_praktikum')
            ->where('id_praktikum', $praktikumId)
            ->where('role', 'Praktikan')
            ->pluck('id_user')
            ->toArray();

        $mahasiswas = User::whereIn('id', $praktikanIds)
            ->select('id', 'nomor_induk', 'nama')
            ->orderBy('nama')
            ->get();

        $existingPresensi = Presensi::where('id_pertemuan', $pertemuanId)
            ->get()
            ->keyBy('id_user');

        $attendanceData = [];
        foreach ($mahasiswas as $mahasiswa) {
            $presensi = $existingPresensi->get($mahasiswa->id);
            $attendanceData[] = [
                'user_id' => $mahasiswa->id,
                'nim' => $mahasiswa->nomor_induk,
                'nama' => $mahasiswa->nama,
                'status' => $presensi ? $presensi->kehadiran : 'Alpha',
                'status_konfirmasi' => $presensi ? $presensi->status : 'Pending',
            ];
        }

        return view('asisten.detailPresensi', compact('pertemuan', 'attendanceData', 'praktikumId'));
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
    public function update(Request $request, int $id)
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
                'data' => $presensi->load('pertemuan', 'user', 'praktikum')
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
    public function getByPraktikum(int $idPraktikum)
    {
        $user = Auth::user();

        try {
            $query = Presensi::whereHas('pertemuan', function ($q) use ($idPraktikum) {
                $q->where('id_praktikum', $idPraktikum);
            })->with(['pertemuan.praktikum', 'user']);

            if ($user->role === 'Praktikan') {
                $presensis = Presensi::where('id_praktikum', $idPraktikum)
                    ->where('id_user', $user->id)
                    ->with('praktikum', 'user')
                    ->get();
            } else {
                $presensis = Presensi::where('id_praktikum', $idPraktikum)
                    ->with('praktikum', 'user');
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
    public function getByPraktikumUser(int $idPraktikum)
    {
        $user = Auth::user();

        try {
            $query = Presensi::whereHas('pertemuan', function ($q) use ($idPraktikum) {
                $q->where('id_praktikum', $idPraktikum);
            })->with(['pertemuan.praktikum', 'user']);

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
    public function getByPraktikumPertemuan(int $idPraktikum)
    {
        $user = Auth::user();

        try {
            $query = Presensi::whereHas('pertemuan', function ($q) use ($idPraktikum) {
                $q->where('id_praktikum', $idPraktikum);
            })->with(['pertemuan.praktikum', 'user']);

            if ($user->role === 'Praktikan') {
                $presensis = Presensi::where('id_praktikum', $idPraktikum)
                    ->where('id_user', $user->id)
                    ->with('praktikum', 'user')
                    ->get();
            } else {
                $presensis = Presensi::where('id_praktikum', $idPraktikum)
                    ->with('praktikum', 'user');
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

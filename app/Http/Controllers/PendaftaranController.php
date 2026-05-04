<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PendaftaranCOntroller extends Controller
{
    public function masterPendaftaran(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $role = $request->get('role');
        
        // Query using DB Builder for pendaftaran_praktikum
        // Join with praktikums and users tables (both have models)
        $query = DB::table('pendaftaran_praktikum')
            ->leftJoin('praktikums', 'pendaftaran_praktikum.id_praktikum', '=', 'praktikums.id')
            ->leftJoin('users', 'pendaftaran_praktikum.id_user', '=', 'users.id')
            ->select(
                'pendaftaran_praktikum.*',
                'praktikums.kode_praktikum',
                'praktikums.nama_praktikum',
                'praktikums.angkatan',
                'praktikums.semester',
                'users.nomor_induk as user_nomor_induk',
                'users.nama as user_nama',
                'users.email as user_email',
                'users.nohp as user_nohp'
            );
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('users.nama', 'like', "%{$search}%")
                  ->orWhere('users.nomor_induk', 'like', "%{$search}%")
                  ->orWhere('praktikums.nama_praktikum', 'like', "%{$search}%")
                  ->orWhere('praktikums.kode_praktikum', 'like', "%{$search}%");
            });
        }
        
        // Apply status filter
        if ($status && in_array($status, ['Dikonfirmasi', 'Ditolak', 'Pending'])) {
            $query->where('pendaftaran_praktikum.status', $status);
        }
        
        // Apply role filter
        if ($role && in_array($role, ['Praktikan', 'Asisten', 'Dosen'])) {
            $query->where('pendaftaran_praktikum.role', $role);
        }
        
        // Order by latest
        $pendaftarans = $query->orderBy('pendaftaran_praktikum.created_at', 'desc')
            ->paginate(10)
            ->through(function ($item) {
                // Convert to object with proper casting
                $item->id = (int) $item->id;
                $item->id_praktikum = (int) $item->id_praktikum;
                $item->id_user = (int) $item->id_user;
                return $item;
            });
        
        // Calculate statistics
        $statistics = [
            'total_pendaftaran' => DB::table('pendaftaran_praktikum')->count(),
            'total_dikonfirmasi' => DB::table('pendaftaran_praktikum')->where('status', 'Dikonfirmasi')->count(),
            'total_ditolak' => DB::table('pendaftaran_praktikum')->where('status', 'Ditolak')->count(),
            'total_pending' => DB::table('pendaftaran_praktikum')->where('status', 'Pending')->count(),
            'total_praktikan' => DB::table('pendaftaran_praktikum')->where('role', 'Praktikan')->count(),
            'total_asisten_dosen' => DB::table('pendaftaran_praktikum')->whereIn('role', ['Asisten', 'Dosen'])->count(),
        ];
        
        return view('laboran.kelolaPendaftaran', compact('pendaftarans', 'statistics'));
    }
}

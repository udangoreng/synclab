<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\Jadwal;
use App\Models\Nilai;
use App\Models\User;
use App\Models\PendaftaranPraktikum;

class Praktikum extends Model
{
    protected $fillable = [
        'kode_praktikum',
        'nama_praktikum',
        'id_dosen',
        'angkatan',
        'semester',
    ];

    /**
     * Praktikum memiliki banyak Jadwal
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'id_praktikum');
    }

    /**
     * Praktikum memiliki banyak Nilai
     */
    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_praktikum');
    }

    /**
     * Praktikum dimiliki oleh satu Dosen
     */
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_dosen')->where('role', 'Dosen');
    }

    /**
     * Praktikum memiliki banyak Pertemuan
     */
    public function pertemuans(): HasMany
    {
        return $this->hasMany(Pertemuan::class, 'id_praktikum');
    }

    /**
     * Get all Asisten through Jadwal → PendaftaranPraktikum → User
     * Note: Use ->get() to execute, not with() for eager loading
     */
    public function getAsistens()
    {
        return User::select('users.*')
            ->join('pendaftaran_praktikum', 'users.id', '=', 'pendaftaran_praktikum.id_user')
            ->join('jadwals', 'pendaftaran_praktikum.id_jadwal', '=', 'jadwals.id')
            ->where('jadwals.id_praktikum', $this->id)
            ->where('pendaftaran_praktikum.role', 'Asisten')
            ->distinct()
            ->get();
    }

    /**
     * Get all Praktikan through Jadwal → PendaftaranPraktikum → User
     * Note: Use ->get() to execute, not with() for eager loading
     */
    public function getPraktikans()
    {
        return User::select('users.*')
            ->join('pendaftaran_praktikum', 'users.id', '=', 'pendaftaran_praktikum.id_user')
            ->join('jadwals', 'pendaftaran_praktikum.id_jadwal', '=', 'jadwals.id')
            ->where('jadwals.id_praktikum', $this->id)
            ->where('pendaftaran_praktikum.role', 'Praktikan')
            ->distinct()
            ->get();
    }
}

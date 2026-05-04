<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Jadwal;
use App\Models\Nilai;
use App\Models\User;
use App\Models\Presensi;

class Praktikum extends Model
{
    protected $fillable = [
        'kode_praktikum',
        'nama_praktikum',
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
     * Relasi ke Asisten melalui pendaftaran_praktikum
     */
    public function asisten(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'pendaftaran_praktikum', 'id_praktikum', 'id_user')
                    ->where('pendaftaran_praktikum.role', 'Asisten')
                    ->where('pendaftaran_praktikum.status', 'Dikonfirmasi')
                    ->withTimestamps();
    }
    
    /**
     * Relasi ke Mahasiswa melalui pendaftaran_praktikum
     */
    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'pendaftaran_praktikum', 'id_praktikum', 'id_user')
                    ->where('pendaftaran_praktikum.role', 'Praktikan')
                    ->where('pendaftaran_praktikum.status', 'Dikonfirmasi')
                    ->withTimestamps();
    }

    /**
     * Praktikum memiliki banyak Presensi
     */
    public function presensis(): HasMany
    {
        return $this->hasMany(Presensi::class, 'id_praktikum');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Jadwal;
use App\Models\Nilai;
use App\Models\User;

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
        return $this->hasMany(Jadwal::class, 'kode_praktikum', 'kode_praktikum');
    }
}

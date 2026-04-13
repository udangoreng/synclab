<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Praktikum memiliki banyak Presensi
     */
    public function presensis(): HasMany
    {
        return $this->hasMany(Presensi::class, 'id_praktikum');
    }
}

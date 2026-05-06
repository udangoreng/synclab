<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    public function moduls(): HasManyThrough
    {
        return $this->hasManyThrough(Modul::class, Pertemuan::class, 'id_praktikum', 'id_pertemuan');
    }

    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'id_praktikum', 'id');
    }
} 

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pertemuan extends Model
{
    protected $fillable = [
        'kode_praktikum',
        'nama_pertemuan',
        'pertemuan_ke',
        'deskripsi_pertemuan',
    ];

    /**
     * Pertemuan dimiliki oleh satu Praktikum
     */
    public function praktikum(): BelongsTo
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum');
    }

    /**
     * Pertemuan memiliki satu Modul
     */
    public function modul(): HasOne
    {
        return $this->hasOne(Modul::class, 'id_pertemuan');
    }

    /**
     * Pertemuan memiliki satu Laporan
     */
    public function laporan(): HasOne
    {
        return $this->hasOne(Laporan::class, 'id_pertemuan');
    }

    /**
     * Pertemuan memiliki banyak Jadwal
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'id_pertemuan');
    }

    /**
     * Pertemuan memiliki banyak Presensi
     */
    public function presensis(): HasMany
    {
        return $this->hasMany(Presensi::class, 'id_pertemuan');
    }

    /**
     * Pertemuan memiliki banyak Nilai (satu per praktikan)
     */
    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_pertemuan');
    }

    /**
     * Pertemuan memiliki banyak Pengumpulan Laporan
     */
    public function pengumpulanLaporans(): HasMany
    {
        return $this->hasMany(PengumpulanLaporan::class, 'id_pertemuan');
    }
}

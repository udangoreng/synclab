<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Jadwal;
use App\Models\Modul;

class Pertemuan extends Model
{
    protected $fillable = [
        'id_praktikum',
        'id_jadwal',
        'id_modul',
        'nama_pertemuan',
        'pertemuan_ke',
        'deskripsi_pertemuan',
    ];

    /**
     * Pertemuan dimiliki oleh satu Praktikum
     */
    public function praktikum(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
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

    public function presensi(): HasMany
    {
        return $this->hasMany(Presensi::class, 'id_pertemuan');
    }

    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_pertemuan');
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'nomor_induk',
        'nama',
        'email',
        'role',
        'password',
    ];

    /**
     * User memiliki banyak Nilai
     */
    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_user');
    }

    /**
     * User memiliki banyak Presensi
     */
    public function presensis(): HasMany
    {
        return $this->hasMany(Presensi::class, 'id_user');
    }

    /**
     * User memiliki banyak Pendaftaran Praktikum
     */
    public function pendaftaranPraktikums(): HasMany
    {
        return $this->hasMany(PendaftaranPraktikum::class, 'id_user');
    }

    /**
     * User memiliki banyak Pengumpulan Laporan
     */
    public function pengumpulanLaporans(): HasMany
    {
        return $this->hasMany(PengumpulanLaporan::class, 'id_user');
    }

    /**
     * User memiliki satu Praktikum (jika role Dosen)
     */
    public function praktikum()
    {
        return $this->hasOne(Praktikum::class, 'id_dosen');
    }
}

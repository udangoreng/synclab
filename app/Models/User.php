<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Models\Praktikum;

class User extends Authenticatable
{
    protected $fillable = [
        'nomor_induk',
        'nama',
        'email',
        'nohp',
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
     * User memiliki banyak Praktikum
     */
    public function praktikums() 
    { 
        return $this->belongsToMany(Praktikum::class, 'pendaftaran_praktikum', 'id_user', 'id_praktikum'); 
    }

    /**
     * User memiliki banyak Jadwal (sebagai dosen/asisten)
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_dosen');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

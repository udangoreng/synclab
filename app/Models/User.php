<?php

namespace App\Models;

<<<<<<< HEAD
// use Illuminate\Contracts\Auth\MustVerifyEmail;
=======
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423
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
<<<<<<< HEAD
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
=======
     /* User memiliki banyak Pendaftaran Praktikum
     */
    }

>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423
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
<<<<<<< HEAD
     * User memiliki satu Praktikum (jika role Dosen)
     */
    public function praktikum()
    {
        return $this->hasOne(Praktikum::class, 'id_dosen');
=======
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423
    }
}

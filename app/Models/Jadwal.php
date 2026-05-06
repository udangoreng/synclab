<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Praktikum;
use App\Models\Laboratorium;
use App\Models\Pertemuan;
=======
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Laboratorium;
use App\Models\Pertemuan;
use App\Models\PendaftaranPraktikum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423

class Jadwal extends Model
{
    protected $fillable = [
        'id_praktikum',
        'id_dosen',
        'id_laboratorium',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'jumlah_max_peserta',
<<<<<<< HEAD
        'status'
=======
        'status',
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423
    ];

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum');
    }
<<<<<<< HEAD
    
    public function laboratorium()
=======

    /**
     * Jadwal memiliki satu Laboratorium
     */
    public function laboratorium(): BelongsTo
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423
    {
        return $this->belongsTo(Laboratorium::class, 'id_laboratorium');
    }

<<<<<<< HEAD
    /**
     * Jadwal memiliki banyak Pendaftaran
     */
    public function pendaftarans(): HasMany
    {
    return $this->hasMany(PendaftaranPraktikum::class, 'id_jadwal');
    }
    
=======
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423
    public function pertemuan(): HasMany
    {
        return $this->hasMany(Pertemuan::class, 'id_jadwal');
    }
    
    public function dosen()
    {
        return $this->belongsTo(User::class, 'id_dosen');
<<<<<<< HEAD
=======
    }
    /**
     * Jadwal memiliki banyak Pendaftaran
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(PendaftaranPraktikum::class, 'id_jadwal');
>>>>>>> 678a83826b4cbe2f46bb253ccc21e84b4d159423
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    protected $fillable = [
        'kode_praktikum',
        'id_dosen',
        'id_pertemuan',
        'id_laboratorium',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'jumlah_max_peserta',
        'status',
    ];

    /**
     * Jadwal dimiliki oleh satu Pertemuan
     */
    public function pertemuan(): BelongsTo
    {
        return $this->belongsTo(Pertemuan::class, 'id_pertemuan');
    }

    /**
     * Jadwal memiliki satu Laboratorium
     */
    public function laboratorium(): BelongsTo
    {
        return $this->belongsTo(Laboratorium::class, 'id_laboratorium');
    }

    /**
     * Jadwal memiliki banyak Pendaftaran
     */
    public function pendaftarans(): HasMany
    {
        return $this->hasMany(PendaftaranPraktikum::class, 'id_jadwal');
    }
}

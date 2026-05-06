<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modul extends Model
{
    protected $fillable = [
        'id_pertemuan',
        'judul_modul',
        'filepath',
        'deskripsi',
    ];

    /**
     * Modul dimiliki oleh satu Pertemuan
     */
    public function pertemuan(): BelongsTo
    {
        return $this->belongsTo(Pertemuan::class, 'id_pertemuan');
    }

    public function praktikum()
    {
        return $this->hasOneThrough(
            Praktikum::class,
            Pertemuan::class,
            'id',         // FK di Pertemuan yang menunjuk ke Modul (sesuaikan)
            'id',         // FK di Praktikum
            'id_pertemuan', // local key di Modul
            'id_praktikum'  // local key di Pertemuan
        );
    }
}

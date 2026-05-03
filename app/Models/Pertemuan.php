<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pertemuan extends Model
{
    protected $fillable = [
        'id_jadwal',
        'id_modul',
        'nama_pertemuan',
        'pertemuan_ke',
        'deskripsi_pertemuan',
    ];

    /**
     * Pertemuan memiliki satu Jadwal
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }

    /**
     * Pertemuan memiliki satu Modul
     */
    public function modul(): BelongsTo
    {
        return $this->belongsTo(Modul::class, 'id_modul');
    }
}

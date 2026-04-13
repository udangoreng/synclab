<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pertemuan extends Model
{
    protected $fillable = [
        'id_jadwal',
        'id_laporan',
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
     * Pertemuan memiliki satu Laporan
     */
    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

    /**
     * Pertemuan memiliki satu Modul
     */
    public function modul(): BelongsTo
    {
        return $this->belongsTo(Modul::class, 'id_modul');
    }
}

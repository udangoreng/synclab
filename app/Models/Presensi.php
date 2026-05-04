<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presensi extends Model
{
    protected $fillable = [
        'id_pertemuan',
        'id_user',
        'kehadiran',
        'status',
    ];

    /**
     * Presensi memiliki satu Praktikum
     */
    public function pertemuan(): BelongsTo
    {
        return $this->belongsTo(Pertemuan::class, 'id_pertemuan');
    }

    /**
     * Presensi memiliki satu User (Praktikan)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

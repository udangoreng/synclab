<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presensi extends Model
{
    protected $fillable = [
        'id_praktikum',
        'id_user',
        'kehadiran',
        'status',
    ];

    /**
     * Presensi memiliki satu Praktikum
     */
    public function praktikum(): BelongsTo
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum');
    }

    /**
     * Presensi memiliki satu User (Praktikan)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

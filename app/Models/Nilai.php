<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $fillable = [
        'id_praktikum',
        'id_user',
        'nilai_pretest',
        'nilai_laporan',
        'nilai_total',
        'nilai_akhir',
        'komentar',
        'status',
    ];

    /**
     * Nilai memiliki satu Praktikum
     */
    public function praktikum(): BelongsTo
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum');
    }

    /**
     * Nilai memiliki satu User (Praktikan)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

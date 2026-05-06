<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftaranPraktikum extends Model
{
    protected $table = 'pendaftaran_praktikum';

    protected $fillable = [
        'id_jadwal',
        'id_user',
        'role',
    ];

    /**
     * Pendaftaran dimiliki oleh satu Jadwal
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }

    /**
     * Pendaftaran dimiliki oleh satu User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
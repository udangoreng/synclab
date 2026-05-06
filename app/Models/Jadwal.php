<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    protected $fillable = [
        'id_praktikum',
        'id_dosen',
        'id_pertemuan',
        'id_laboratorium',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'jumlah_max_peserta',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Jadwal dimiliki oleh satu Praktikum
     */
    public function praktikum(): BelongsTo
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum');
    }

    /**
     * Jadwal dimiliki oleh satu Dosen
     */
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_dosen', 'nomor_induk');
    }

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

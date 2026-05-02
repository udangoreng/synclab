<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'status'
    ];

    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class, 'id_praktikum');
    }
    
    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class, 'id_laboratorium');
    }
    
    public function dosen()
    {
        return $this->belongsTo(User::class, 'id_dosen');
    }
}

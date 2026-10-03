<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';
    protected $fillable = [ 
        'hewan_id', 'layanan_id', 'tanggal_masuk', 'tanggal_keluar', 'status',
        'alasan_penolakan', 'estimasi_selesai', 'foto_before', 'foto_after',
    ];

    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}

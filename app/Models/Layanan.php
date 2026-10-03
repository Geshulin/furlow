<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $fillable = ['nama_layanan', 'harga', 'deskripsi'];

    public function booking ()
    {
        return $this->hasMany(Booking::class);
    }
}

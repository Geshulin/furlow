<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    use SoftDeletes;

    protected $table = 'layanan';
    protected $fillable = ['nama_layanan', 'harga', 'deskripsi'];

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

}

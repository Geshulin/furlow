<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use SoftDeletes;

    protected $table = 'hewan';
    protected $fillable = ['user_id', 'nama', 'jenis', 'catatan_kesehatan', 'foto'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}

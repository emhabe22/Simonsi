<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $guarded = [];
    
    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function absensi () {
        return $this->hasMany(Absensi::class,'guru_id','id');
    }

    public function kelas () {
        return $this->belongsTo(User::class,'kelas_id','id');
    }
}

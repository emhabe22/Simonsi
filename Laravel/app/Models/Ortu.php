<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    protected $guarded = [];
    
     public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $guarded = [];
    
     public function ortu () {
        return $this->hasMany(Ortu::class,'siswa_id','id');
    }

    public function kelas () {
        return $this->belongsTo(Kelas::class,'kelas_id','id');
    }

    public function absensi () {
        return $this->hasMany(Absensi::class,'siswa_id','id');
    }
}

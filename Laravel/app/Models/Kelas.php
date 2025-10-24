<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = [];
    

    public function siswas () {
        return $this->hasMany(Siswa::class,'kelas_id','id');
    }

    public function mapel () {
        return $this->hasMany(Mapel::class,'kelas_id','id');
    }

    public function guru () {
        return $this->hasMany(Guru::class,'kelas_id','id');
    }
}

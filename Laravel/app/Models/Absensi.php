<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $guarded = [];

    public function siswa () {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
    public function guru () {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }
}

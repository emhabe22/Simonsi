<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';
    protected $guarded = [];

    // Relasi: satu siswa punya satu ortu
    public function ortu()
    {
        return $this->hasOne(Ortu::class, 'siswa_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'siswa_id', 'id');
    }
}

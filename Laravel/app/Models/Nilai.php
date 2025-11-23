<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Nilai extends Model
{

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }
    protected $guarded = [];
    use HasFactory;

    protected $fillable = [
        'siswa_id', 'kelas_id','guru_id', 'mapel_id', 'tahun_akademik_id', 'semester_id',
        'proses1', 'proses2', 'uts', 'proses3', 'proses4', 'uas', 'catatan'
    ];

    public function siswa() { return $this->belongsTo(Siswa::class); }
    public function mapel() { return $this->belongsTo(Mapel::class); }
    public function semester() { return $this->belongsTo(Semester::class); }
    public function tahunAkademik() { return $this->belongsTo(TahunAkademik::class); }
}


    

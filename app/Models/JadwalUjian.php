<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    use HasFactory;

    protected $fillable = ['id_jadwal_ujian', 'id_bank_ujian', 'tgl_mulai', 'tgl_selesai'];
    protected $table = 'jadwal_ujian';
<<<<<<< HEAD

    public function alokasiWaktu()
    {
        return $this->hasMany(AlokasiWaktu::class, 'id_jadwal_ujian');
    }
=======
>>>>>>> 9f5d545 (first commitu)
}

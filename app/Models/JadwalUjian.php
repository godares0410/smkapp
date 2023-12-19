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
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> e8f7dd6 (first commit)

    public function alokasiWaktu()
    {
        return $this->hasMany(AlokasiWaktu::class, 'id_jadwal_ujian');
    }
<<<<<<< HEAD
=======
>>>>>>> 9f5d545 (first commitu)
=======
>>>>>>> 25eed0c (first commitz)
=======
>>>>>>> 680cd4c (first commit)
>>>>>>> e8f7dd6 (first commit)
}

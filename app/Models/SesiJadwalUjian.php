<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiJadwalUjian extends Model
{
    protected $table = 'sesi_jadwal_ujian';

    // Sesuaikan atribut-atribut yang diperlukan
<<<<<<< HEAD
    protected $fillable = ['id_jadwal_ujian', 'id_sesi', 'id_alokasi_waktu'];
=======
    protected $fillable = [
        'id_jadwal_ujian',
        'sesi',
        'jam_mulai',
        'jam_selesai',
    ];
>>>>>>> 9f5d545 (first commitu)
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiJadwalUjian extends Model
{
    protected $table = 'sesi_jadwal_ujian';

    // Sesuaikan atribut-atribut yang diperlukan
<<<<<<< HEAD
<<<<<<< HEAD
    protected $fillable = ['id_jadwal_ujian', 'id_sesi', 'id_alokasi_waktu'];
=======
=======
>>>>>>> 25eed0c (first commitz)
    protected $fillable = [
        'id_jadwal_ujian',
        'sesi',
        'jam_mulai',
        'jam_selesai',
    ];
<<<<<<< HEAD
>>>>>>> 9f5d545 (first commitu)
=======
>>>>>>> 25eed0c (first commitz)
}
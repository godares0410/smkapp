<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlokasiWaktu extends Model
{
    use HasFactory;

    protected $fillable = ['id_jadwal_ujian', 'id_sesi', 'id_alokasi_waktu'];
    protected $table = 'alokasi_waktu';
    protected $primaryKey = 'id_alokasi_waktu';
}

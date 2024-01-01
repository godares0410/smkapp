<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaAbsen extends Model
{
    protected $table = 'siswa_absen';
    protected $primaryKey = 'id_siswa';
    // Sesuaikan atribut-atribut yang diperlukan
    protected $fillable = [
        'id_siswa_absen',
        'id_siswa',
        'keterangan',
        'jam_ke',
        'tanggal',
    ];
}
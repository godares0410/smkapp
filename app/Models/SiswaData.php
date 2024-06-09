<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaData extends Model
{
    use HasFactory;

    protected $guarded = 'id_siswa_data';
    protected $table = 'siswa_data';
    protected $primaryKey = 'id_siswa_data';
}

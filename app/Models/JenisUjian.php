<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUjian extends Model
{
    use HasFactory;

    protected $guarded = 'id_jenis';
    protected $table = 'jenis_ujian';
    protected $primaryKey = 'id_jenis';
}

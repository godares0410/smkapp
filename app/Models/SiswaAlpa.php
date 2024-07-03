<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaAlpa extends Model
{
    use HasFactory;

    protected $guarded = 'id_siswa_alpa';
    protected $table = 'siswa_alpa';
    protected $primaryKey = 'id_siswa_alpa';
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaScan extends Model
{
    use HasFactory;

    protected $guarded = 'id_siswa_scan';
    protected $table = 'siswa_scan';
    protected $primaryKey = 'id_siswa_scan';
}

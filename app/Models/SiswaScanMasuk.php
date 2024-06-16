<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaScanMasuk extends Model
{
    use HasFactory;

    protected $guarded = 'id_siswa_scan_masuk';
    protected $table = 'siswa_scan_masuk';
    protected $primaryKey = 'id_siswa_scan_masuk';
}

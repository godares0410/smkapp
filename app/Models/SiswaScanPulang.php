<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaScanPulang extends Model
{
    use HasFactory;

    protected $guarded = 'id_siswa_scan_pulang';
    protected $table = 'siswa_scan_pulang';
    protected $primaryKey = 'id_siswa_scan_pulang';
}

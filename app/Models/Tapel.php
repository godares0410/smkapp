<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tapel extends Model
{
    use HasFactory;
    protected $guarded = 'id_tapel';
    protected $table = 'tahun_pelajaran';
    protected $primaryKey = 'id_tapel';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $guarded = ['id_ujian'];
    protected $table = 'ujian';
    protected $primarykey = ['id_ujian'];
}

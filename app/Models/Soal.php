<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $guarded = 'id_soal';
    protected $table = 'soal';
    protected $primaryKey = 'id_soal';
}

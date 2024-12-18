<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $guarded = 'id_jabatan';
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
}

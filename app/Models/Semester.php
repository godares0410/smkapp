<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    use HasFactory;
    protected $guarded = 'id_semester';
    protected $table = 'semester';
    protected $primaryKey = 'id_semester';
}

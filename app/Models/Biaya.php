<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $guarded = 'id_biaya';
    protected $table = 'biaya';
    protected $primaryKey = 'id_biaya';
}

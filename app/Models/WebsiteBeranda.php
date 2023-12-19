<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteBeranda extends Model
{
    use HasFactory;

    protected $guarded = 'id_beranda';
    protected $table = 'website_beranda';
    protected $primaryKey = 'id_beranda';
}

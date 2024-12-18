<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = 'id_pembayaran';
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
}

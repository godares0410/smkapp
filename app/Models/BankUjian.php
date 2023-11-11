<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankUjian extends Model
{
    use HasFactory;

    protected $guarded = 'id_bank_ujian';
    protected $table = 'bank_ujian';
    protected $primaryKey = 'id_bank_ujian';
}

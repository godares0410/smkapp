<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    use HasFactory;

    protected $guarded = 'id_soal';
    protected $table = 'bank_soal';
    protected $primaryKey = 'id_soal';
}

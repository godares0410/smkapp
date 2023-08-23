<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = ['nama_guru', 'jabatan','foto'];
    protected $table = 'guru';

    // public function kelas()
    // {
    //     return $this->belongsTo(Kelas::class);
    // }

    // public function jurusan()
    // {
    //     return $this->belongsTo(Jurusan::class);
    // }
    public function gurumapel()
    {
        return $this->hasMany(Gurumapel::class, 'id_guru', 'id_guru');
    }
}
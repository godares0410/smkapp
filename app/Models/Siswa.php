<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Siswa extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory;

    protected $guarded = 'id_siswa';
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
    public function alpa()
    {
        return $this->hasOne(SiswaAlpa::class, 'id_siswa', 'id_siswa');
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walas extends Model
{
    use HasFactory;
    
    protected $table = 'walas';
    protected $primaryKey = 'id_walas';
    protected $guarded = []; // Gunakan array kosong jika tidak ada kolom yang diproteksi secara massal

    // Model Walas
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
    
}

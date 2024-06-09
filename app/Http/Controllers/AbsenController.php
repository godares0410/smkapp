<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function cari($id)
    {
        $siswa = Siswa::where('id_siswa', $id)
            ->select('siswa.*')
            ->first();
        return view('siswa.cek_absen.index', compact('siswa'));
    }
}

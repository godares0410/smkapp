<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\SiswaAbsen;
use App\Models\RekapAbsen;

use Illuminate\Http\Request;

class RekapAbsenController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('data_cetak.rekap_absen.index', compact('kelas', 'jurusan'));
    }
    public function rekap(Request $request)
    {
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');
        $nama = SiswaAbsen::select('siswa.id_siswa', 'siswa.nama_siswa', 'siswa_absen.keterangan')
    ->join('siswa', 'siswa.id_siswa', '=', 'siswa_absen.id_siswa')
    ->where('siswa.id_kelas', $kelas)
    ->where('siswa.id_jurusan', $jurusan)
    ->groupBy('siswa.id_siswa', 'siswa.nama_siswa', 'siswa_absen.keterangan')
    ->get();
    $siswa = Siswa::select('siswa.*', 'kelas.nama_kelas', 'jurusan.nama_jurusan')
    ->where('siswa.id_kelas', $kelas)
    ->where('siswa.id_jurusan', $jurusan)
    ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
    ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
    ->get();
    $score = [
        'siswa' => $siswa,
        'nama' => $nama,
    ];
        return view('data_cetak.rekap_absen.tampil', compact('score'));
    }
}

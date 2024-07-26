<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Siswa;

use Illuminate\Http\Request;

class KartuController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('data_cetak.kartu_peserta.index', compact('kelas', 'jurusan'));
    }
    public function ktp()
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('data_cetak.kartu_peserta.indexktp', compact('kelas', 'jurusan'));
    }
    public function cetakkartu(Request $request)
    {
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');
        $siswa = Siswa::select('siswa.*', 'kelas.nama_kelas', 'jurusan.nama_jurusan', 'siswa_kartu.*', 'sesi.nama_sesi', 'ruang.nama_ruang', 'siswa_data.*')
        ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
        ->join('jurusan', 'jurusan.id_jurusan', '=', 'siswa.id_jurusan')
        ->join('siswa_kartu', 'siswa_kartu.id_siswa', '=', 'siswa.id_siswa')
        ->join('siswa_sesi', 'siswa_sesi.id_siswa', '=', 'siswa.id_siswa')
        ->join('sesi', 'siswa_sesi.id_sesi', '=', 'sesi.id_sesi')
        ->join('siswa_ruang', 'siswa_ruang.id_siswa', '=', 'siswa.id_siswa')
        ->join('ruang', 'siswa_ruang.id_ruang', '=', 'ruang.id_ruang')
        ->join('siswa_data', 'siswa.id_siswa', '=', 'siswa_data.id_siswa')
        ->where('siswa.id_kelas', $kelas)
        ->where('siswa.id_jurusan', $jurusan)
        ->get();

        return view('data_cetak.kartu_peserta.cetak', compact('siswa'));
    }
    public function cetakktp(Request $request)
    {
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');
        $siswa = Siswa::select('siswa.*', 'kelas.nama_kelas', 'jurusan.nama_jurusan', 'siswa_data.*')
        ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
        ->join('jurusan', 'jurusan.id_jurusan', '=', 'siswa.id_jurusan')
        ->join('siswa_data', 'siswa.id_siswa', '=', 'siswa_data.id_siswa')
        ->where('siswa.id_kelas', $kelas)
        ->where('siswa.id_jurusan', $jurusan)
        ->get();

        return view('data_cetak.kartu_peserta.ktp', compact('siswa'));
    }

}

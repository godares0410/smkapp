<?php

namespace App\Exports;

use App\Models\Siswa;
use App\Models\SiswaNilai;
use illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromView;

class ExportNilai implements FromView
{
    public function view(): View
    {
        $jenis = Request::input('jenis');
        $kelas = Request::input('kelas');
        $jurusan = Request::input('jurusan');
        $mapel = Request::input('mapel');

        $siswa = Siswa::select('siswa.*')
            ->where('id_kelas', $kelas)
            ->where('id_jurusan', $jurusan)
            ->orderBy('id_siswa', 'asc')
            ->get();
        $nilai = SiswaNilai::select('mapel.nama_mapel', 'kelas.nama_kelas', 'jurusan.nama_jurusan', 'siswa_nilai.nilai', 'siswa_nilai.id_siswa')
            ->join('mapel', 'siswa_nilai.id_mapel', '=', 'mapel.id_mapel')
            ->join('jurusan', 'siswa_nilai.id_jurusan', '=', 'jurusan.id_jurusan')
            ->join('kelas', 'siswa_nilai.id_kelas', '=', 'kelas.id_kelas')
            ->join('siswa', 'siswa_nilai.id_siswa', '=', 'siswa.id_siswa')
            ->where('siswa_nilai.id_jenis', $jenis)
            ->where('siswa_nilai.id_kelas', $kelas)
            ->where('siswa_nilai.id_jurusan', $jurusan)
            ->where('siswa_nilai.id_mapel', $mapel)
            ->whereIn('siswa_nilai.id_siswa', $siswa->pluck('id_siswa'))
            ->get();

        $score = [
            'siswa' => $siswa,
            'nilai' => $nilai,
        ];

        return view('data_assesment.nilai.table', $score);
    }
}

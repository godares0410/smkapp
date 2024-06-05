<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalUjian;
use App\Models\Sesi;
use App\Models\Ruang;
use App\Models\Siswa;

class CetakController extends Controller
{
    public function index()
    {
        $jadwal = JadwalUjian::select('jadwal_ujian.*', 'mapel.nama_mapel', 'kelas.nama_kelas', 'bank_ujian.id_jurusan', 'bank_ujian.jumlah_soal', 'jenis_ujian.nama_ujian')
        ->join('bank_ujian', 'bank_ujian.id_bank_ujian', '=', 'jadwal_ujian.id_bank_ujian')
        ->join('jenis_ujian', 'jenis_ujian.id_jenis', '=', 'bank_ujian.id_jenis')
        ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
        ->join('kelas', 'kelas.id_kelas', '=', 'bank_ujian.id_kelas')
        ->orderBy('jadwal_ujian.id_jadwal_ujian', 'desc')
        ->get();
        $sesi = Sesi::all();
        $ruang = Ruang::all();
        return view('data_cetak.daftar_hadir.index', compact('jadwal', 'sesi', 'ruang'));
    }
    public function cetakdaftar(Request $request)
    {
        $jenis = $request->input('jenis');
        $sesi = $request->input('sesi');
        $ruang = $request->input('ruang');
        $proktor = $request->input('proktor');
        $pengawas = $request->input('pengawas');
        $tdkhadir = $request->input('tdkhadir');

        $ssi = Sesi::where('id_sesi', $sesi)
        ->value('id_sesi');
        $rg = Ruang::where('id_ruang', $ruang)
        ->value('id_ruang');
        $ruangs = Ruang::select('nama_ruang')
        ->where('id_ruang', $ruang)
        ->first();
        $sesis = Sesi::select('nama_sesi')
        ->where('id_sesi', $sesi)
        ->first();
        $siswa = Siswa::select('siswa.*', 'kelas.nama_kelas', 'kode_jurusan')
        ->join('siswa_sesi', 'siswa_sesi.id_siswa', '=', 'siswa.id_siswa' )
        ->join('siswa_ruang', 'siswa_ruang.id_siswa', '=', 'siswa.id_siswa' )
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas' )
        ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan' )
        ->where('siswa_sesi.id_sesi', $ssi)
        ->where('siswa_ruang.id_ruang', $rg)
        ->get();
        $jumlah_siswa = $siswa->count();
        $jadwal = JadwalUjian::select('mapel.nama_mapel as nm', 'alokasi_waktu.jam_mulai as jm', 'alokasi_waktu.jam_selesai as js', 'jadwal_ujian.tgl_mulai as tm')
            ->where('jadwal_ujian.id_jadwal_ujian', $jenis)
            ->join('sesi_jadwal_ujian', 'sesi_jadwal_ujian.id_jadwal_ujian', '=', 'jadwal_ujian.id_jadwal_ujian')
            ->where('sesi_jadwal_ujian.id_sesi', $sesi)
            ->join('alokasi_waktu', 'sesi_jadwal_ujian.id_alokasi_waktu', '=', 'alokasi_waktu.id_alokasi_waktu')
            ->join('bank_ujian', 'jadwal_ujian.id_bank_ujian', '=', 'bank_ujian.id_bank_ujian')
            ->join('mapel', 'bank_ujian.id_mapel', '=', 'mapel.id_mapel')
            ->first();
        return view('data_cetak.daftar_hadir.cetak', compact('siswa', 'jumlah_siswa', 'proktor', 'pengawas', 'tdkhadir', 'ruangs', 'sesis', 'jadwal'));
    }
}

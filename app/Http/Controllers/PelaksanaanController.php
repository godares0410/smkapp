<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiswaUjian;
use App\Models\Siswa;
use App\Models\JadwalUjian;
use App\Models\SiswaNilai;
use App\Models\SiswaMulai;
use Illuminate\Support\Facades\DB;

class PelaksanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subquery = SiswaUjian::select('siswa_ujian.id_siswa')
        ->groupBy('siswa_ujian.id_siswa')
        ->get();
    
    $subzero = SiswaUjian::select('siswa_ujian.id_jadwal_ujian')
        ->groupBy('siswa_ujian.id_jadwal_ujian')
        ->get();

    $siswa = SiswaUjian::select(
        'siswa.id_siswa',
        'siswa.nama_siswa',
        'kelas.nama_kelas',
        'jurusan.nama_jurusan',
        'mapel.nama_mapel',
        'jadwal_ujian.id_jadwal_ujian',
        DB::raw('COUNT(*) as total'),
        DB::raw('COUNT(CASE WHEN siswa_ujian.jawaban IS NULL THEN 1 END) as tidak_terjawab'),
        DB::raw('COUNT(CASE WHEN siswa_ujian.jawaban IS NOT NULL THEN 1 END) as terjawab'),
        DB::raw('SUM(siswa_ujian.point) as nilai')
    )
    ->join('siswa', 'siswa.id_siswa', '=', 'siswa_ujian.id_siswa')
    ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
    ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
    ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal_ujian', '=', 'siswa_ujian.id_jadwal_ujian')
    ->join('bank_ujian', 'bank_ujian.id_bank_ujian', '=', 'jadwal_ujian.id_bank_ujian')
    ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
    ->whereIn('siswa.id_siswa', $subquery)
    ->whereIn('jadwal_ujian.id_jadwal_ujian', $subzero)
    ->groupBy('siswa.id_siswa', 'siswa.nama_siswa', 'kelas.nama_kelas', 'jurusan.nama_jurusan', 'mapel.nama_mapel', 'jadwal_ujian.id_jadwal_ujian')
    ->get();


        return view ('data_pelaksanaan.pelaksanaan.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id, $idUj)
    {
        SiswaUjian::where('id_siswa', $id)
            ->where('id_jadwal_ujian', $idUj)
            ->delete();
            return redirect()->back()->with('success', 'Berhasil Dihapus');
    }
    public function selesaikan($id, $idUj)
    {
            $id_kelas = Siswa::where('id_siswa', $id)->value('id_kelas');
            $id_jurusan = Siswa::where('id_siswa', $id)->value('id_jurusan');
            // $idUj = $request->idUj;

            $totalPoint = SiswaUjian::where('id_jadwal_ujian', $idUj)
                ->where('id_siswa', $id)
                ->sum('point');
            $mapel = JadwalUjian::where('id_jadwal_ujian', $idUj)
                ->join('bank_ujian', 'jadwal_ujian.id_bank_ujian', '=', 'bank_ujian.id_bank_ujian')
                ->join('jenis_ujian', 'bank_ujian.id_jenis', '=', 'jenis_ujian.id_jenis')
                ->join('mapel', 'bank_ujian.id_mapel', '=', 'mapel.id_mapel')
                ->select('mapel.id_mapel', 'jenis_ujian.id_jenis')
                ->first();

            // Pastikan $mapel tidak null sebelum digunakan
            if (!$mapel) {
                throw new \Exception('Jadwal ujian tidak valid.');
            }

            $nilai = new SiswaNilai;
            $nilai->id_siswa = $id;
            $nilai->id_kelas = $id_kelas;
            $nilai->id_jurusan = $id_jurusan;
            $nilai->id_jenis = $mapel->id_jenis;
            $nilai->id_mapel = $mapel->id_mapel;
            $nilai->nilai = $totalPoint;
            $nilai->save();


            SiswaUjian::where('id_jadwal_ujian', $idUj)
            ->where('id_siswa', $id)
            ->delete();
            SiswaMulai::where('id_jadwal_ujian', $idUj)
            ->where('id_siswa', $id)
            ->delete();

            // Tambahkan pengalihan ke halaman tujuan setelah menyimpan nilai
            return redirect()->back()->with('success', 'Berhasil ditambahkan');
    }
    public function reset()
    {
        $reset = SiswaNilai::select('siswa.nama_siswa', 'kelas.nama_kelas', 'jurusan.nama_jurusan', 'jenis_ujian.nama_ujian', 'mapel.nama_mapel', 'siswa_nilai.*')
        ->join('siswa', 'siswa.id_siswa', '=', 'siswa_nilai.id_siswa')
        ->join('kelas', 'siswa_nilai.id_kelas', '=', 'kelas.id_kelas')
        ->join('jurusan', 'siswa_nilai.id_jurusan', '=', 'jurusan.id_jurusan')
        ->join('jenis_ujian', 'siswa_nilai.id_jenis', '=', 'jenis_ujian.id_jenis')
        ->join('mapel', 'mapel.id_mapel', '=', 'siswa_nilai.id_mapel')
        ->orderBy('siswa_nilai.id_siswa_nilai', 'desc')
        ->get();
        // dd($reset);
        return view('data_pelaksanaan.reset.index', compact('reset'));
    }
    public function resetdestroy($idSiswaUjian)
    {
        SiswaNilai::where('id_siswa_nilai', $idSiswaUjian)
        ->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }
}

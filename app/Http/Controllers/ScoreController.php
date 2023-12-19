<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;

use App\Models\Jurusan;
use App\Models\JenisUjian;
use App\Models\SiswaNilai;
use App\Exports\ExportNilai;
use App\Exports\ExportRekap;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = JenisUjian::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $mapel = Mapel::all();
        return view('data_assesment.nilai.index', compact('kelas', 'jurusan', 'mapel', 'jenis'));
    }

    public function nilai(Request $request)
    {
        $jenis = $request->input('jenis');
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');
        $mapel = $request->input('mapel');
        $siswa = Siswa::select('siswa.*')
            ->where('id_kelas', $kelas)
            ->where('id_jurusan', $jurusan)
            ->orderBy('nama_siswa', 'asc')
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
        $idm = Mapel::where('id_mapel', $mapel)
        ->select('id_mapel', 'nama_mapel')
        ->first();
        return view('data_assesment.nilai.indux', compact('score', 'kelas', 'jurusan', 'mapel', 'jenis', 'idm'));
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
    public function destroy($id)
    {
        //
    }

    public function exportData(Request $request)
    {
        $jenis = $request->input('jenis');
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');
        $mapel = $request->input('mapel');
        $request->merge(['jenis' => $jenis, 'kelas' => $kelas, 'jurusan' => $jurusan, 'mapel' => $mapel,]);
        $nama_jenis = JenisUjian::where('id_jenis', $jenis)
            ->value('nama_ujian');
        $nama_kelas = Kelas::where('id_kelas', $kelas)
            ->value('nama_kelas');
        $nama_jurusan = Jurusan::where('id_jurusan', $jurusan)
            ->value('nama_jurusan');
        $nama_mapel = Mapel::where('id_mapel', $mapel)
            ->value('nama_mapel');
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

        return Excel::download(new ExportNilai($score), "{$nama_jenis}_{$nama_mapel}_{$nama_kelas}_{$nama_jurusan}.xlsx");
    }

    public function fetchMapelOptions(Request $request)
    {
        $selectedKelas = $request->input('kelas');
        $selectedJurusan = $request->input('jurusan');

        $mapelOptions = YourMapelModel::where('id_kelas', $selectedKelas)
            ->where(function ($query) use ($selectedJurusan) {
                foreach ($selectedJurusan as $jurusan) {
                    $query->orWhereJsonContains('id_jurusan', $jurusan);
                }
            })
            ->get();
        return response()->json($mapelOptions);
    }
    public function rekap()
    {
        $jenis = JenisUjian::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('data_assesment.rekap.index', compact('kelas', 'jurusan', 'jenis'));
    }
    public function rekapnilai(Request $request)
    {
        $jenis = $request->input('jenis');
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');

        $siswa = Siswa::select('siswa.*')
            ->where('id_kelas', $kelas)
            ->where('id_jurusan', $jurusan)
            ->orderBy('nama_siswa', 'asc')
            ->get();
        $mapel = Mapel::select('mapel.*')
        ->where('id_kelas', $kelas)
        ->whereJsonContains('id_jurusan', $jurusan)
        ->get();
        $idMapels = $mapel->pluck('id_mapel');
        $nilai = SiswaNilai::select('mapel.nama_mapel', 'kelas.nama_kelas', 'jurusan.nama_jurusan', 'siswa_nilai.nilai', 'siswa_nilai.id_siswa', 'siswa_nilai.id_mapel as idm')
        ->join('mapel', 'siswa_nilai.id_mapel', '=', 'mapel.id_mapel')
        ->join('jurusan', 'siswa_nilai.id_jurusan', '=', 'jurusan.id_jurusan')
        ->join('kelas', 'siswa_nilai.id_kelas', '=', 'kelas.id_kelas')
        ->join('siswa', 'siswa_nilai.id_siswa', '=', 'siswa.id_siswa')
        ->where('siswa_nilai.id_jenis', $jenis)
        ->where('siswa_nilai.id_kelas', $kelas)
        ->where('siswa_nilai.id_jurusan', $jurusan)
        ->whereIn('siswa_nilai.id_mapel', $idMapels)
        ->whereIn('siswa_nilai.id_siswa', $siswa->pluck('id_siswa'))
        ->get();
        $score = [
            'mapel' => $mapel,
            'siswa' => $siswa,
            'nilai' => $nilai,
        ];
        return view('data_assesment.rekap.indux', compact('siswa','jenis', 'kelas', 'jurusan', 'nilai', 'score', 'mapel'));
    }
    public function rekapeksport(Request $request)
    {
        $jenis = $request->input('jenis');
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');
    }
    public function exportRekap(Request $request)
    {
        $jenis = $request->input('jenis');
        $kelas = $request->input('kelas');
        $jurusan = $request->input('jurusan');
        $request->merge(['jenis' => $jenis, 'kelas' => $kelas, 'jurusan' => $jurusan,]);
        $nama_jenis = JenisUjian::where('id_jenis', $jenis)
            ->value('nama_ujian');
        $nama_kelas = Kelas::where('id_kelas', $kelas)
            ->value('nama_kelas');
        $nama_jurusan = Jurusan::where('id_jurusan', $jurusan)
            ->value('nama_jurusan');
        $siswa = Siswa::select('siswa.*')
            ->where('id_kelas', $kelas)
            ->where('id_jurusan', $jurusan)
            ->orderBy('id_siswa', 'asc')
            ->get();
            $mapel = Mapel::select('mapel.*')
            ->where('id_kelas', $kelas)
            ->whereJsonContains('id_jurusan', $jurusan)
            ->get();
            $idMapels = $mapel->pluck('id_mapel');
            $nilai = SiswaNilai::select('mapel.nama_mapel', 'kelas.nama_kelas', 'jurusan.nama_jurusan', 'siswa_nilai.nilai', 'siswa_nilai.id_siswa', 'siswa_nilai.id_mapel as idm')
            ->join('mapel', 'siswa_nilai.id_mapel', '=', 'mapel.id_mapel')
            ->join('jurusan', 'siswa_nilai.id_jurusan', '=', 'jurusan.id_jurusan')
            ->join('kelas', 'siswa_nilai.id_kelas', '=', 'kelas.id_kelas')
            ->join('siswa', 'siswa_nilai.id_siswa', '=', 'siswa.id_siswa')
            ->where('siswa_nilai.id_jenis', $jenis)
            ->where('siswa_nilai.id_kelas', $kelas)
            ->where('siswa_nilai.id_jurusan', $jurusan)
            ->whereIn('siswa_nilai.id_mapel', $idMapels)
            ->whereIn('siswa_nilai.id_siswa', $siswa->pluck('id_siswa'))
            ->get();
            $score = [
                'mapel' => $mapel,
                'siswa' => $siswa,
                'nilai' => $nilai,
            ];

        return Excel::download(new ExportRekap($score), "{$nama_jenis}_{$nama_kelas}_{$nama_jurusan}.xlsx");
    }
}

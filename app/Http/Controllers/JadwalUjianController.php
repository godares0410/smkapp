<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\AlokasiWaktu;
use App\Models\BankUjian;
use App\Models\JadwalUjian;
use Illuminate\Http\Request;
use App\Models\SesiJadwalUjian;
use App\Models\SiswaUjian;

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank = BankUjian::select('bank_ujian.*', 'kelas.nama_kelas', 'jenis_ujian.nama_ujian', 'mapel.nama_mapel')
            ->join('kelas', 'kelas.id_kelas', '=', 'bank_ujian.id_kelas')
            ->join('jenis_ujian', 'jenis_ujian.id_jenis', '=', 'bank_ujian.id_jenis')
            ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
            ->orderBy('bank_ujian.id_bank_ujian', 'desc')
            ->get();
        $jadwal = JadwalUjian::select('jadwal_ujian.*', 'mapel.nama_mapel', 'kelas.nama_kelas', 'bank_ujian.id_jurusan', 'bank_ujian.jumlah_soal')
            ->join('bank_ujian', 'bank_ujian.id_bank_ujian', '=', 'jadwal_ujian.id_bank_ujian')
            ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
            ->join('kelas', 'kelas.id_kelas', '=', 'bank_ujian.id_kelas')
            ->orderBy('jadwal_ujian.id_jadwal_ujian', 'desc')
            ->get();
        $sesi = Sesi::all();
        $sesiUjian = SesiJadwalUjian::select('sesi.nama_sesi', 'sesi_jadwal_ujian.id_jadwal_ujian', 'alokasi_waktu.*')
        ->join('jadwal_ujian', 'sesi_jadwal_ujian.id_jadwal_ujian', '=', 'jadwal_ujian.id_jadwal_ujian')
        ->join('alokasi_waktu', 'alokasi_waktu.id_alokasi_waktu', '=', 'sesi_jadwal_ujian.id_alokasi_waktu')
        ->join('sesi', 'sesi.id_sesi', '=', 'sesi_jadwal_ujian.id_sesi')
        ->get();
        // $alokasi = AlokasiWaktu::select('alokasi_waktu.*', 'sesi.nama_sesi');
        $alokasi = AlokasiWaktu::select('alokasi_waktu.*', 'sesi.nama_sesi')
        ->join('sesi', 'alokasi_waktu.id_sesi', '=', 'sesi.id_sesi')
        ->get();
        return view('data_ujian.jadwal_ujian.indux', compact('bank', 'sesi', 'jadwal', 'alokasi', 'sesiUjian'));
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
    // Insert data into the database
    $sesiIds = $request->input('sesi');
    $durasi = $request->input('durasi');
    $mulai = $request->input('mulai');
    $selesai = $request->input('selesai');
    $bank = $request->input('bank_ujian');

    $jadwal = new JadwalUjian();
    $jadwal->id_bank_ujian = $bank;
    $jadwal->durasi = $durasi;
    $jadwal->tgl_mulai = $mulai;
    $jadwal->tgl_selesai = $selesai;
    $jadwal->save();

    $insertData = [];

    foreach ($sesiIds as $index => $sesiId) {
        $jamMulaiValue = $request->input("jam_mulai.$index");
        $jamSelesaiValue = $request->input("jam_selesai.$index");

        // Check if the sesi ID is checked and both jam_mulai and jam_selesai are not null
        if ($request->has("sesi.$index") && $jamMulaiValue !== null && $jamSelesaiValue !== null) {
            $insertData[] = [
                'id_jadwal_ujian' => $jadwal->id,
                'id_sesi' => $sesiId,
                'id_alokasi_waktu' => null, // You will update this value in the next step
            ];
        }
    }
    foreach ($request->input('sesi') as $index => $sesiId) {
        $jamKe = $request->input("jam_ke.$index");
    
        // Check if the sesi ID is checked and jam_ke is not null
        if ($request->has("sesi.$index") && $jamKe !== null) {
            $result = AlokasiWaktu::where('id_sesi', $sesiId)
                ->where('id_jam_ke', $jamKe)
                ->pluck('id_alokasi_waktu')
                ->first();
    
            if ($result) {
                $insertData[] = [
                    'id_jadwal_ujian' => $jadwal->id,
                    'id_sesi' => $sesiId,
                    'id_alokasi_waktu' => $result,
                ];
            }
        }
    }

    // Insert the data with the updated 'id_alokasi_waktu' values into the sesi_jadwal_ujian table
    try {
        SesiJadwalUjian::insert($insertData);
    } catch (\Exception $e) {
        // Handle the exception as needed
        return redirect()->back()->with('error', 'Failed to create jadwal');
    }

    return redirect()->back()->with('success', 'Jadwal created successfully');
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
        JadwalUjian::where('id_jadwal_ujian', $id)->delete();
        SesiJadwalUjian::where('id_jadwal_ujian', $id)->delete();
        SiswaUjian::where('id_jadwal_ujian', $id)->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus');
    }
    public function fetchJamKe($sesiId)
    {
        // Fetch jam_ke data based on the selected sesi ID
        $jamKeData = AlokasiWaktu::where('id_sesi', $sesiId)->get();

        return response()->json($jamKeData);
    }
}

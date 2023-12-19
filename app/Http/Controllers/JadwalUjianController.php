<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use App\Models\AlokasiWaktu;
=======
>>>>>>> 9f5d545 (first commitu)
=======
>>>>>>> 25eed0c (first commitz)
=======
=======
use App\Models\AlokasiWaktu;
>>>>>>> 680cd4c (first commit)
>>>>>>> e8f7dd6 (first commit)
use App\Models\BankUjian;
use App\Models\JadwalUjian;
use Illuminate\Http\Request;
use App\Models\SesiJadwalUjian;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use App\Models\SiswaUjian;
=======
>>>>>>> 9f5d545 (first commitu)
=======
>>>>>>> 25eed0c (first commitz)
=======
=======
use App\Models\SiswaUjian;
>>>>>>> 680cd4c (first commit)
>>>>>>> e8f7dd6 (first commit)

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
        // $jadwalujian = JadwalUjian::all();
        // $bankUjian = BankUjian::all();
>>>>>>> 9f5d545 (first commitu)
=======
        // $jadwalujian = JadwalUjian::all();
        // $bankUjian = BankUjian::all();
>>>>>>> 25eed0c (first commitz)
=======
        // $jadwalujian = JadwalUjian::all();
        // $bankUjian = BankUjian::all();
=======
>>>>>>> 680cd4c (first commit)
>>>>>>> e8f7dd6 (first commit)
        $bank = BankUjian::select('bank_ujian.*', 'kelas.nama_kelas', 'jenis_ujian.nama_ujian', 'mapel.nama_mapel')
            ->join('kelas', 'kelas.id_kelas', '=', 'bank_ujian.id_kelas')
            ->join('jenis_ujian', 'jenis_ujian.id_jenis', '=', 'bank_ujian.id_jenis')
            ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            ->orderBy('bank_ujian.id_bank_ujian', 'desc')
=======
>>>>>>> 9f5d545 (first commitu)
=======
>>>>>>> 25eed0c (first commitz)
=======
=======
            ->orderBy('bank_ujian.id_bank_ujian', 'desc')
>>>>>>> 680cd4c (first commit)
>>>>>>> e8f7dd6 (first commit)
            ->get();
        $jadwal = JadwalUjian::select('jadwal_ujian.*', 'mapel.nama_mapel', 'kelas.nama_kelas', 'bank_ujian.id_jurusan', 'bank_ujian.jumlah_soal')
            ->join('bank_ujian', 'bank_ujian.id_bank_ujian', '=', 'jadwal_ujian.id_bank_ujian')
            ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
            ->join('kelas', 'kelas.id_kelas', '=', 'bank_ujian.id_kelas')
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
            ->get();
        $sesi = Sesi::all();
        return view('data_ujian.jadwal_ujian.index', compact('bank', 'sesi', 'jadwal'));
>>>>>>> 9f5d545 (first commitu)
=======
            ->get();
        $sesi = Sesi::all();
        return view('data_ujian.jadwal_ujian.index', compact('bank', 'sesi', 'jadwal'));
>>>>>>> 25eed0c (first commitz)
=======
            ->get();
        $sesi = Sesi::all();
        return view('data_ujian.jadwal_ujian.index', compact('bank', 'sesi', 'jadwal'));
=======
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
>>>>>>> 680cd4c (first commit)
>>>>>>> e8f7dd6 (first commit)
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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
=======
>>>>>>> 25eed0c (first commitz)
=======
>>>>>>> e8f7dd6 (first commit)
    {
        // Validate the form data
        $validator = $request->validate([
            'bank_ujian' => 'required',
            'durasi' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
            'sesi.*' => 'exists:sesi,id_sesi', // Validate that each sesi exists in the 'sesi' table
            'jam_mulai.*' => 'nullable|date_format:H:i', // Allow null or valid time format
            'jam_selesai.*' => 'nullable|date_format:H:i', // Allow null or valid time format
        ]);

        // Insert data into the database
        $sesiIds = $request->input('sesi');
        $durasi = $request->input('durasi');
        $mulai = $request->input('mulai');
        $selesai = $request->input('selesai');
        $jamMulai = $request->input('jam_mulai');
        $jamSelesai = $request->input('jam_selesai');
        $bank = $request->input('bank_ujian');

        // Assuming you have a Jadwal model with a relationship to Sesi model
        $jadwal = new JadwalUjian();
        $jadwal->id_bank_ujian = $bank;
        $jadwal->durasi = $durasi;
        $jadwal->tgl_mulai = $mulai;
        $jadwal->tgl_selesai = $selesai;
        $jadwal->save();

        $insertData = [];
        // $sesiIds = $request->input('sesi');

        foreach ($sesiIds as $index => $sesiId) {
            $jamMulaiValue = $request->input("jam_mulai.$index");
            $jamSelesaiValue = $request->input("jam_selesai.$index");

            // Check if the sesi ID is checked and both jam_mulai and jam_selesai are not null
            if ($request->has("sesi.$index") && $jamMulaiValue !== null && $jamSelesaiValue !== null) {
                $insertData[] = [
                    'id_jadwal_ujian' => $jadwal->id,
                    'id_sesi' => $sesiId,
                    'jam_mulai' => $jamMulaiValue,
                    'jam_selesai' => $jamSelesaiValue,
                ];
            }
        }

        // Perform the multiple insert
        SesiJadwalUjian::insert($insertData);

        return redirect()->back()->with('success', 'Jadwal created successfully');
    }

<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 9f5d545 (first commitu)
=======
>>>>>>> 25eed0c (first commitz)
=======
=======
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
>>>>>>> 680cd4c (first commit)
>>>>>>> e8f7dd6 (first commit)





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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
        //
>>>>>>> 9f5d545 (first commitu)
=======
        //
>>>>>>> 25eed0c (first commitz)
=======
        //
=======
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
>>>>>>> 680cd4c (first commit)
>>>>>>> e8f7dd6 (first commit)
    }
}

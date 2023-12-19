<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
<<<<<<<< HEAD:app/Http/Controllers/AlokasiController.php
=======
>>>>>>> e8f7dd6 (first commit)
use App\Models\AlokasiWaktu;
use App\Models\Sesi;
use Illuminate\Http\Request;

class AlokasiController extends Controller
<<<<<<< HEAD
========
use App\Models\Makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
>>>>>>>> 25eed0c (first commitz):app/Http/Controllers/MakananController.php
=======
>>>>>>> e8f7dd6 (first commit)
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
<<<<<<<< HEAD:app/Http/Controllers/AlokasiController.php
=======
>>>>>>> e8f7dd6 (first commit)
        $alokasi = AlokasiWaktu::select('sesi.nama_sesi', 'alokasi_waktu.*')
        ->join('sesi', 'alokasi_waktu.id_sesi', '=', 'sesi.id_sesi')
        ->get();
        $sesi = Sesi::all();

        return view ('data_ujian.alokasi_waktu.index', compact('alokasi', 'sesi'));
<<<<<<< HEAD
========
        $tipeMakanan = request('tipe_makanan'); // Ambil parameter 'tipe_makanan' dari URL
        $makanans = Makanan::when($tipeMakanan, function ($query) use ($tipeMakanan) {
            return $query->whereJsonContains('tipe_makanan', $tipeMakanan);
        })->get();
        return view('test.test', compact('makanans'));
>>>>>>>> 25eed0c (first commitz):app/Http/Controllers/MakananController.php
=======
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
    {
<<<<<<< HEAD
<<<<<<<< HEAD:app/Http/Controllers/AlokasiController.php
=======
>>>>>>> e8f7dd6 (first commit)
        $alokasi = new AlokasiWaktu;
        $alokasi->id_sesi = $request->sesi;
        $alokasi->id_jam_ke = $request->jam_sesi;
        $alokasi->jam_mulai = $request->jam_mulai;
        $alokasi->jam_selesai = $request->jam_selesai;
        $alokasi->save();

        return redirect()->back()->with('success', 'Alokasi berhasil ditambahkan');
<<<<<<< HEAD
========
         // Validasi formulir
         $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'tipe_makanan' => 'required|array',
        ]);

        // Mengonversi array ke dalam format yang sesuai untuk penyimpanan
        $tipeMakanan = json_encode($request->tipe_makanan);

        // Proses penyimpanan data
        $makanan = new Makanan([
            'nama_makanan' => $request->nama_makanan,
            'tipe_makanan' => $tipeMakanan,
        ]);

        $makanan->save();

        // Tampilkan pesan sukses
        return "Data Makanan berhasil disimpan!";
>>>>>>>> 25eed0c (first commitz):app/Http/Controllers/MakananController.php
=======
>>>>>>> e8f7dd6 (first commit)
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
}

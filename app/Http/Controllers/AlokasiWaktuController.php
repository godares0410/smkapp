<?php

namespace App\Http\Controllers;

use App\Models\AlokasiWaktu;
use App\Models\Sesi;
use Illuminate\Http\Request;

class AlokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alokasi = AlokasiWaktu::select('sesi.nama_sesi', 'alokasi_waktu.*')
        ->join('sesi', 'alokasi_waktu.id_sesi', '=', 'sesi.id_sesi')
        ->get();
        $sesi = Sesi::all();

        return view ('data_ujian.alokasi_waktu.index', compact('alokasi', 'sesi'));
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
        $alokasi = new AlokasiWaktu;
        $alokasi->id_sesi = $request->sesi;
        $alokasi->id_jam_ke = $request->jam_sesi;
        $alokasi->jam_mulai = $request->jam_mulai;
        $alokasi->jam_selesai = $request->jam_selesai;
        $alokasi->save();

        return redirect()->back()->with('success', 'Alokasi berhasil ditambahkan');
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

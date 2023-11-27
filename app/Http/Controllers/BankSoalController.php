<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\BankSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banksoal = BankSoal::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('data_ujian.bank_soal.index', compact('banksoal', 'kelas', 'jurusan'));
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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $banksoal = new Banksoal;
        $banksoal->nama_bank_soal = $request->nama_bank_soal;
        $banksoal->kelas = $request->kelas;
        $banksoal->jurusan = $request->jurusan;
        $banksoal->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankSoalController  $bankSoalController
     * @return \Illuminate\Http\Response
     */
    public function show(BankSoalController $bankSoalController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankSoalController  $bankSoalController
     * @return \Illuminate\Http\Response
     */
    public function edit(BankSoalController $bankSoalController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankSoalController  $bankSoalController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankSoalController $bankSoalController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankSoalController  $bankSoalController
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankSoalController $bankSoalController)
    {
        //
    }
}

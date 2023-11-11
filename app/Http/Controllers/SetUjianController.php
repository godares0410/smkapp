<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\BankSoal;
use App\Models\BankUjian;
use App\Models\JenisUjian;
use Illuminate\Http\Request;

class SetUjianController extends Controller
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
        $mapel = Mapel::all();
        $guru = Guru::all();
        $banksoal = BankSoal::all();
        $bankujian = BankUjian::all();

        return view('data_ujian.ujian.index', compact('jenis', 'kelas', 'mapel', 'guru', 'banksoal', 'bankujian'));
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
        $request->validate([
            'nama_ujian' => 'required',
            'kode_ujian' => 'required',
        ]);
        $jenis = new JenisUjian;
        $jenis->nama_ujian = $request->nama_ujian;
        $jenis->kode_ujian = $request->kode_ujian;
        $jenis->save();

        // Tampilkan pesan success
        return redirect()->route('jenis_ujian.index')->with('success', 'Data jurusan berhasil ditambahkan.');
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
        // Perform validation or authorization checks if necessary

        // Find the resource by ID
        $resource = JenisUjian::find($id);

        // Check if the resource exists
        if ($resource) {
            // Delete the resource
            $resource->delete();

            return redirect()->route('jenis_ujian.index')
                ->with('success', 'Jenis ujian berhasil dihapus.');
        } else {
            // Handle the case where the resource doesn't exist
        }
    }
}

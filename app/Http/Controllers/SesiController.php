<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $jamOption = $this->generateJamOptions();
        $sesi = Sesi::all();

        return view('data_ujian.sesi.index', compact('sesi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function generateJamOptions()
    {
        $jamOptions = [];
        for ($jam = 0; $jam <= 23; $jam++) {
            $jamOptions[$jam] = sprintf('%02d:00', $jam); // Format jam seperti "01:00"
        }
        return $jamOptions;
    }
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
            'nama_sesi' => 'required',
            'kode_sesi' => 'required',
        ]);
        $sesi = new Sesi;
        $sesi->nama_sesi = $request->nama_sesi;
        $sesi->kode_sesi = $request->kode_sesi;
        $sesi->mulai = $request->mulai;
        $sesi->sampai = $request->sampai;
        $sesi->save();

        // Tampilkan pesan success
        return redirect()->route('sesi.index')->with('success', 'Data jurusan berhasil ditambahkan.');
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
        $sesi = Sesi::where('id_sesi', $id);
        $data = [
            'nama_sesi'     => $request->nama_sesi,
            'kode_sesi'   => $request->kode_sesi,
            'mulai'   => $request->mulai,
            'sampai'   => $request->sampai,
        ];
        $sesi->update($data);
        return redirect()->route('sesi.index')->with('success', 'Data siswa berhasil di edit.');

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
        $resource = Sesi::find($id);

        // Check if the resource exists
        if ($resource) {
            // Delete the resource
            $resource->delete();

            return redirect()->route('sesi.index')
                ->with('success', 'Sesi berhasil dihapus.');
        } else {
            return redirect()->route('sesi.index')
                ->with('error', 'Sesi gagal dihapus.');
        }
    }
}

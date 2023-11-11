<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MapelImport;
use Illuminate\Support\Facades\Session;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::all();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        return view('data_umum.mapel.index', compact('mapel', 'kelas', 'jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kode_mapel' => 'required',
            'nama_kelas' => 'required',
        ]);

        $mapel = new Mapel;
        $mapel->nama_mapel = $request->nama_mapel;
        $mapel->kode_mapel = $request->kode_mapel;
        $mapel->nama_kelas = $request->nama_kelas;
        $mapel->save();

        return redirect()->back()->with('success', 'Mapel berhasil ditambahkan');
    }



    public function import(Request $request)
    {

        Excel::import(new MapelImport, $request->file('file'));

        return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil diimport.');
    }
}

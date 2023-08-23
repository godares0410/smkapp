<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JurusanImport;
use Illuminate\Support\Facades\Session;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('data_umum.jurusan.index', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required',
            'kode_jurusan' => 'required',
        ]);
        $jurusan = new Jurusan;
        $jurusan->nama_jurusan = $request->nama_jurusan;
        $jurusan->kode_jurusan = $request->kode_jurusan;
        $jurusan->save();

        // Tampilkan pesan success
        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil ditambahkan.');
    }



    public function import(Request $request)
    {

        Excel::import(new JurusanImport, $request->file('file'));

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil diimport.');
    }
}

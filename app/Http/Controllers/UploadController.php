<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload.index');
    }
    public function fileupload(Request $request)
    {


        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = $foto->getClientOriginalName();
            // $namaFoto = $request->nama_siswa . '_' . time() . '.' . $request->foto->extension();
            // $foto->move(public_path('img/kartu'), $namaFoto);
            $foto->move(public_path('img/file'), $namaFoto);
            // $namaFoto = $request->nama_siswa . '_' . time() . '.' . $request->foto->extension();
            // $foto->move(public_path('img/website/logo'), $namaFoto);
        }
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }
}

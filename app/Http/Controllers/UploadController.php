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
        $nama = $request->input('nama');

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = $foto->getClientOriginalName();
            $foto->move(public_path('img/' . $nama), $namaFoto);
        }

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }
}

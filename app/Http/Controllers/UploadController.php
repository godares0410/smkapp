<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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


    public function deleteFolder()
    {
        $directory = public_path('img/scan');

        // Check if directory exists
        if (File::exists($directory)) {
            // Delete directory and its contents
            File::deleteDirectory($directory);
            
            return response()->json(['message' => 'Directory deleted successfully!'], 200);
        }

        return response()->json(['message' => 'Directory does not exist!'], 404);
    }

}

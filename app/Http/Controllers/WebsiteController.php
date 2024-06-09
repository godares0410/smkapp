<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\WebsiteBeranda;

class WebsiteController extends Controller
{
    public function index()
    {
        $beranda = WebsiteBeranda::all();
        return view('website.landing.index', compact('beranda'));
    }
    public function beranda()
    {
        $beranda = WebsiteBeranda::all();
        return view('data_website.beranda.index', compact('beranda'));
    }
    public function berandastore(Request $request)
    {

        // Validasi input
        $validator = Validator::make($request->all(), [
            // 'nama_siswa' => 'required',
            // 'kelas' => 'required',
            // 'jurusan' => 'required',
            // 'foto' => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('foto')) {
                $errorMessage = 'Gagal Upload, ukuran maksimal foto 2Mb';
                session()->flash('error', $errorMessage);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $web = new WebsiteBeranda;
        $web->tag = $request->tag;
        $web->keterangan = $request->keterangan;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = $foto->getClientOriginalName();
            // $namaFoto = $request->nama_siswa . '_' . time() . '.' . $request->foto->extension();
            // $foto->move(public_path('img/kartu'), $namaFoto);
            $foto->move(public_path('img/ktp'), $namaFoto);
            // $namaFoto = $request->nama_siswa . '_' . time() . '.' . $request->foto->extension();
            // $foto->move(public_path('img/website/logo'), $namaFoto);
            $web->foto = $namaFoto;
        }
        $web->save();
        if (session()->has('error')) {
            $errorMessage = session()->get('error');
            session()->forget('error');
            return redirect()->back()->with('error', $errorMessage);
        }
        return redirect()->route('website.beranda')->with('success', 'Data berhasil ditambahkan.');
    }
}

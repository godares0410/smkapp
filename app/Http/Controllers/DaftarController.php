<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Validator;

class DaftarController extends Controller
{
    public function index()
    {
        return view('daftar.index');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric|unique:data_pendaftaran',
            'no_kk' => 'required|unique:data_pendaftaran',
            'email' => 'required|unique:data_pendaftaran',
            'no_wa' => 'required|unique:data_pendaftaran',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nik.unique' => 'NIK sudah digunakan.',
            'no_kk.unique' => 'Nomor KK sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
            'no_wa.unique' => 'Nomor WA sudah digunakan.',
            'foto.mimes' => 'Foto harus berupa jpeg, png, jpg.',
            'foto.max' => 'Ukuran Foto Maksimal 2MB.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $pendaftaran = new Pendaftaran;
        $pendaftaran->nik = $request->nik;
        $pendaftaran->no_kk = $request->no_kk;
        $pendaftaran->nama_pendaftar = $request->nama;
        $pendaftaran->tempat = $request->tempatl;
        $pendaftaran->ttl = $request->tgl;
        $pendaftaran->nama_wali = $request->wali;
        $pendaftaran->alamat = $request->alamat;
        $pendaftaran->asal_sekolah = $request->asal;
        $pendaftaran->jurusan = $request->jurusan;
        $pendaftaran->email = $request->email;
        $pendaftaran->no_wa = $request->no_wa;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            // $namaFoto = $foto->getClientOriginalName();
            $namaFoto = $request->nama . '_' . time() . '.' . $request->foto->extension();
            $foto->move(public_path('img/ppdb'), $namaFoto);
            $pendaftaran->foto = $namaFoto;
        }
        $pendaftaran->guru = $request->guru;
        $pendaftaran->save();
        return redirect()->route('daftar.index')->with('success', 'Pendaftaran Berhasil');
    }
    public function daftar()
    {
        $pendaftar = Pendaftaran::all();
        return view('data_ppdb.index', compact('pendaftar'));
    }
    public function destroy($id)
    {
        // Temukan BankSoal berdasarkan ID
        $pendaftar = Pendaftaran::findOrFail($id);

        // Path ke folder public/img/ppdb
        $photoPath = public_path('img/ppdb/' . $pendaftar->foto);

        // Cek apakah foto ada
        if (file_exists($photoPath)) {
            // Hapus foto
            unlink($photoPath);
        }
        Pendaftaran::where('id_pendaftar', $id)->delete();
        // Hapus record dari database
        $pendaftar->delete();

        return redirect()->back()->with('success', 'Pendaftar berhasil dihapus');
    }
}

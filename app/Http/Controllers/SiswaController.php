<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('data_umum.siswa.index', compact('siswa', 'kelas', 'jurusan'));
    }

    public function store(Request $request)
    {

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('foto')) {
                $errorMessage = 'Gagal Upload, ukuran maksimal foto 2Mb';
                session()->flash('error', $errorMessage);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $siswa = new Siswa;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->kelas = $request->kelas;
        $siswa->jurusan = $request->jurusan;
        $siswa->rombel = $request->rombel ?? $request->kelas . ' ' . $request->jurusan;
        // $siswa->foto = $fotoName;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            // $namaFoto = $foto->getClientOriginalName();
            $namaFoto = $request->nama_siswa . '_' . time() . '.' . $request->foto->extension();
            $foto->move(public_path('img/siswa'), $namaFoto);
            $siswa->foto = $namaFoto;
        }
        $siswa->save();

        if (session()->has('error')) {
            $errorMessage = session()->get('error');
            session()->forget('error');
            return redirect()->back()->with('error', $errorMessage);
        }

        // Tampilkan pesan success
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }



    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
        ], [
            'file.required' => 'File tidak boleh kosong.',
            'file.mimes' => 'Format file salah! Masukkan File Sesuai Format',
        ]);

        if ($validator->fails()) {
            return redirect()->route('siswa.index')->withErrors($validator);
        }

        try {
            Excel::import(new SiswaImport, $request->file('file'));

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $siswa = Siswa::where('id_siswa', $id);
        $data = [
            'nama_siswa'     => $request->nama_siswa,
            'kelas'   => $request->kelas,
            'jurusan'   => $request->jurusan,
        ];

        // if ($request->hasFile('foto')) {
        //     $fotoLama = $siswa->foto;
        //     if ($fotoLama) {
        //         // Hapus foto lama dari penyimpanan
        //         Storage::delete(public_path('img/siswa'), $fotoLama);
        //     }
        // }

        $siswu = Siswa::where('id_siswa', $id)->first();
        $fotoLama = $siswu->foto;
        if ($fotoLama) {
            // Hapus foto lama dari penyimpanan
            File::delete(public_path('img/siswa/' . $fotoLama));
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            // $namaFoto = $foto->getClientOriginalName();
            $namaFoto = $request->nama_siswa . '_' . time() . '.' . $request->foto->extension();
            $foto->move(public_path('img/siswa'), $namaFoto);
            $data['foto'] = $namaFoto;
        }
        $siswa->update($data);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil di edit.');
    }

    public function destroy()
    {
        //
    }
}

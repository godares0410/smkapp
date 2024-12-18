<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuruImport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::leftJoin('jabatan', 'jabatan.id_jabatan', '=', 'guru.id_jabatan')
        ->leftJoin('walas', 'walas.id_guru', '=', 'guru.id_guru')
        ->leftJoin('kelas', 'walas.id_kelas', '=', 'kelas.id_kelas')
        ->leftJoin('jurusan', 'walas.id_jurusan', '=', 'jurusan.id_jurusan')
        ->select(
            'guru.*',
            DB::raw('CASE WHEN guru.id_jabatan IS NULL THEN "guru" ELSE jabatan.nama_jabatan END AS nama_jabatan'), 'kelas.nama_kelas', 'jurusan.kode_jurusan'
        )
        ->orderBy('guru.nama_guru', 'asc')
        ->get();
        return view('data_umum.guru.index', compact('guru'));
    }
    public function dashboard()
    {
        // $guru = Guru::all();
        return view('guru.dashboard');
    }

    public function store(Request $request)
    {

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_guru' => 'required',
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
        $guru = new Guru;
        $guru->nama_guru = $request->nama_guru;
        $guru->jabatan = $request->jabatan;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            // $namaFoto = $foto->getClientOriginalName();
            $namaFoto = $request->nama_guru . '_' . time() . '.' . $request->foto->extension();
            $foto->move(public_path('img/guru'), $namaFoto);
            $guru->foto = $namaFoto;
        }
        $guru->save();

        if (session()->has('error')) {
            $errorMessage = session()->get('error');
            session()->forget('error');
            return redirect()->back()->with('error', $errorMessage);
        }

        // Tampilkan pesan success
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
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
            return redirect()->route('guru.index')->withErrors($validator);
        }
        // }
        try {
            Excel::import(new GuruImport, $request->file('file'));

            return redirect()->route('guru.index')->with('success', 'Data guru berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->route('guru.index')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
    public function absen()
    {
        $kelas = Auth::guard('guru')->user()->walas->id_kelas;
        $jurusan = Auth::guard('guru')->user()->walas->id_jurusan;
        $absen = SiswaAbsen::all();
        $siswa = Siswa::select('siswa.*', 'kelas.nama_kelas', 'jurusan.nama_jurusan')
        ->where('siswa.id_kelas', $kelas)
        ->where('siswa.id_jurusan', $jurusan)
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
        ->get();
        return view('guru.absen.index', compact('siswa', 'absen'));
    }
}

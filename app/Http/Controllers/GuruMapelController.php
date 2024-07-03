<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\GuruMapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GuruMapelController extends Controller
{
    public function index()
    {
        
        $gurus = Guru::all();
        $mapels = Mapel::all();
        return view('data_umum.guru_mapel.index', compact('gurus', 'mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required',
            'nama_mapel' => 'required|array',
        ]);

        $guru_id = $request->nama_guru;
        $mapel_ids = $request->nama_mapel;

        // Simpan data ke tabel pivot guru_mapel
        foreach ($mapel_ids as $mapel_id) {
            GuruMapel::create([
                'guru_id' => $guru_id,
                'mapel_id' => $mapel_id,
            ]);
        }

        return back()->with('success', 'Data berhasil disimpan.');
    }
    public function destroy($mapel_id)
    {
        $deleted = GuruMapel::where('id_mapel', $mapel_id)->delete();

        if ($deleted) {
            return redirect()->route('guru_mapel.index')
                ->with('success', 'Data mata pelajaran berhasil dihapus.');
        }

        return redirect()->route('guru_mapel.index')
            ->with('error', 'Gagal menghapus data mata pelajaran.');
    }
}

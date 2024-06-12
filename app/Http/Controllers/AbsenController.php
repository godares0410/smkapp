<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\SiswaScan;
use Illuminate\Http\Request;

class AbsenController extends Controller
{

    public function index()
    {
        return view('absen.index');
    }
    public function pkl()
    {
        return view('absen.pkl');
    }
    public function store(Request $request)
    {
        // Decode the image from base64 format
        $screenshot = $request->input('screenshot');
        $image = str_replace('data:image/png;base64,', '', $screenshot);
        $image = str_replace(' ', '+', $image);
        $imageName = 'scan_' . time() . '.png';

        // Path to the directory
        $directory = public_path('img/scan');

        // Create directory if it doesn't exist
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true); // 0755 is the default permission
        }

        // Save the image to the directory
        $imagePath = $directory . '/' . $imageName;
        file_put_contents($imagePath, base64_decode($image));

        // Save the record to the database
        $abs = new SiswaScan();
        $abs->id_siswa = $request->input('idsiswa');
        $abs->foto = $imageName;
        $abs->save();

        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }
    public function cari($id)
    {
        $siswa = Siswa::where('id_siswa', $id)
            ->select('siswa.*')
            ->first();
        return view('siswa.cek_absen.index', compact('siswa'));
    }
}

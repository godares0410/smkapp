<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\SiswaScanMasuk;
use App\Models\SiswaScanPulang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsenController extends Controller
{

    public function index()
    {
        return view('absen.index');
    }
    public function pkl()
    {
        $idSiswa = Auth::guard('siswa')->user()->id_siswa;
        return view('absen.pkl', compact('idSiswa'));
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

    // Get the current time
    $currentTime = new \DateTime();
    $currentHourMinute = $currentTime->format('H:i');

    // Define the time ranges
    $masukStart = new \DateTime('06:00');
    $masukEnd = new \DateTime('07:30');
    $pulangStart = new \DateTime('12:00');
    $pulangEnd = new \DateTime('13:30');

    // Check if the current time is within the "Masuk" range
    if ($currentTime >= $masukStart && $currentTime <= $masukEnd) {
        // Save the record to the SiswaScanMasuk table
        $abs = new SiswaScanMasuk();
        $abs->id_siswa = $request->input('idsiswa');
        $abs->foto = $imageName;
        $abs->save();

        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }

    // Check if the current time is within the "Pulang" range
    if ($currentTime >= $pulangStart && $currentTime <= $pulangEnd) {
        // Save the record to the SiswaScanPulang table
        $abs = new SiswaScanPulang();
        $abs->id_siswa = $request->input('idsiswa');
        $abs->foto = $imageName;
        $abs->save();

        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }

    // If the time is not within any valid range, redirect with an error
    if ($currentTime < $masukStart || ($currentTime > $masukEnd && $currentTime < $pulangStart) || $currentTime > $pulangEnd) {
        $error = ($currentTime < $masukStart || $currentTime > $masukEnd) ? 'Jam Masuk Tidak Sesuai' : 'Jam Pulang Tidak Sesuai';
        return redirect()->back()->with('error', $error);
    }

    return redirect()->back()->with('error', 'Invalid request.');
    }


    public function pklstore(Request $request)
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

    // Use Carbon to get the current time in Jakarta
    $jakartaTime = Carbon::now('Asia/Jakarta');

    $abs = new SiswaScanMasuk();
    $abs->id_siswa = $request->input('idsiswa');
    $abs->foto = $imageName;
    $abs->created_at = $jakartaTime;
    $abs->updated_at = $jakartaTime;
    $abs->save();

    $plg = new SiswaScanPulang();
    $plg->id_siswa = $request->input('idsiswa');
    $plg->foto = $imageName;
    $plg->created_at = $jakartaTime;
    $plg->updated_at = $jakartaTime;
    $plg->save();

    return redirect()->back()->with('success', 'Absen Berhasil!');
    // return redirect()->route('siswa.dashboard')->with('success', 'Data Ujian Berhasil Ditambahkan.');
}

    public function cari($id)
    {
        $siswa = Siswa::where('id_siswa', $id)
            ->select('siswa.*')
            ->first();
        return view('siswa.cek_absen.index', compact('siswa'));
    }
}

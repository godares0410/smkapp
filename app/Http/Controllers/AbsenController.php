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
    // Set the default timezone to Asia/Jakarta (WIB - Western Indonesian Time)
    date_default_timezone_set('Asia/Jakarta');

    // Decode the image from base64 format
    $screenshot = $request->input('screenshot');
    $image = str_replace('data:image/png;base64,', '', $screenshot);
    $image = str_replace(' ', '+', $image);
    $imageName = 'scan_' . time() . '.png';

    // Get the current time in Asia/Jakarta timezone
    $currentTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
    $currentHourMinute = $currentTime->format('H:i');

    // Define the time ranges in Asia/Jakarta timezone
    $masukStart = new \DateTime('06:00', new \DateTimeZone('Asia/Jakarta'));
    $masukEnd = new \DateTime('17:30', new \DateTimeZone('Asia/Jakarta'));
    $pulangStart = new \DateTime('12:00', new \DateTimeZone('Asia/Jakarta'));
    $pulangEnd = new \DateTime('13:30', new \DateTimeZone('Asia/Jakarta'));

    // Check if the current time is within the "Masuk" range
    if ($currentTime >= $masukStart && $currentTime <= $masukEnd) {
        // Set the directory for "Masuk" scans
        $directory = public_path('img/scan/masuk');
        
        // Create directory if it doesn't exist
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true); // 0755 is the default permission
        }

        // Save the image to the directory
        $imagePath = $directory . '/' . $imageName;
        file_put_contents($imagePath, base64_decode($image));

        // Save the record to the SiswaScanMasuk table
        $abs = new SiswaScanMasuk();
        $abs->id_siswa = $request->input('idsiswa');
        $abs->foto = $imageName;
        $abs->save();

        return redirect()->back()->with('success', 'Absen Masuk Berhasil!');
    }

    // Check if the current time is within the "Pulang" range
    if ($currentTime >= $pulangStart && $currentTime <= $pulangEnd) {
        // Set the directory for "Pulang" scans
        $directory = public_path('img/scan/pulang');

        // Create directory if it doesn't exist
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true); // 0755 is the default permission
        }

        // Save the image to the directory
        $imagePath = $directory . '/' . $imageName;
        file_put_contents($imagePath, base64_decode($image));

        // Save the record to the SiswaScanPulang table
        $abs = new SiswaScanPulang();
        $abs->id_siswa = $request->input('idsiswa');
        $abs->foto = $imageName;
        $abs->save();

        return redirect()->back()->with('success', 'Absen Pulang Berhasil!');
    }

    // If the current time does not match any range, return an error message
    return redirect()->back()->with('error', 'Current time does not match any allowed scan time range.');
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

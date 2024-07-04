<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\SiswaScanMasuk;
use App\Models\SiswaScanPulang;
use App\Models\SiswaAlpa;
use App\Models\Tapel;
use App\Models\Semester;
use App\Models\RekapAbsen;
use App\Models\ScanMasuk;
use App\Models\ScanPulang;
use App\Models\Biaya;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AbsenController extends Controller
{

    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

        // Query untuk mengambil data scan masuk siswa dengan filter tanggal hari ini
        $sm = SiswaScanMasuk::select('siswa.nama_siswa', 'siswa_scan_masuk.*', 'siswa.foto as fotosis', 'kelas.nama_kelas', 'jurusan.kode_jurusan', 'siswa_scan_masuk.created_at as msk')
        ->join('siswa', 'siswa.id_siswa', '=', 'siswa_scan_masuk.id_siswa')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
        ->whereDate('siswa_scan_masuk.created_at', $today)
        ->orderBy('id_siswa_scan_masuk', 'desc')
        ->get()
        ->map(function ($item) {
            // Convert the timestamp to Asia/Jakarta timezone
            $item->msk = Carbon::parse($item->msk)->setTimezone('Asia/Jakarta');
            return $item;
        });
        $sp = SiswaScanPulang::select('siswa.nama_siswa', 'siswa_scan_pulang.*', 'siswa.foto as fotosis', 'kelas.nama_kelas', 'jurusan.kode_jurusan', 'siswa_scan_pulang.created_at as plg')
        ->join('siswa', 'siswa.id_siswa', '=', 'siswa_scan_pulang.id_siswa')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
        ->whereDate('siswa_scan_pulang.created_at', $today)
        ->OrderBy('id_siswa_scan_pulang','desc')
        ->get()
        ->map(function ($item) {
            // Convert the timestamp to Asia/Jakarta timezone
            $item->plg = Carbon::parse($item->plg)->setTimezone('Asia/Jakarta');
            return $item;
        });;
        return view('absen.index', compact('sm', 'sp'));
    }
    public function pkl()
    {
        $idSiswa = Auth::guard('siswa')->user()->id_siswa;
        return view('absen.pkl', compact('idSiswa'));
    }
    // public function store(Request $request)
    // {
    //     // Set the default timezone to Asia/Jakarta (WIB - Western Indonesian Time)
    //     date_default_timezone_set('Asia/Jakarta');

    //     // Decode the image from base64 format
    //     $screenshot = $request->input('screenshot');
    //     $image = str_replace('data:image/png;base64,', '', $screenshot);
    //     $image = str_replace(' ', '+', $image);
    //     $imageName = 'scan_' . time() . '.png';

    //     // Get the current time in Asia/Jakarta timezone
    //     $currentTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
    //     $currentHourMinute = $currentTime->format('H:i');

    //     // Define the time ranges in Asia/Jakarta timezone
    //     $masukStart = new \DateTime('07:00', new \DateTimeZone('Asia/Jakarta'));
    //     $masukEnd = new \DateTime('07:30', new \DateTimeZone('Asia/Jakarta'));
    //     $pulangStart = new \DateTime('07:00', new \DateTimeZone('Asia/Jakarta'));
    //     $pulangEnd = new \DateTime('23:30', new \DateTimeZone('Asia/Jakarta'));

    //     // Check if the current time is within the "Masuk" range
    //     if ($currentTime >= $masukStart && $currentTime <= $masukEnd) {
    //         // Check if id_siswa already exists in SiswaScanMasuk
    //         $exists = SiswaScanMasuk::where('id_siswa', $request->input('idsiswa'))
    //                                 ->whereDate('created_at', Carbon::today())
    //                                 ->exists();

    //         if ($exists) {
    //             return redirect()->back()->with('error', 'Sudah Scan Masuk Hari Ini');
    //         }

    //         // Set the directory for "Masuk" scans
    //         $directory = public_path('img/scan/masuk');

    //         // Create directory if it doesn't exist
    //         if (!file_exists($directory)) {
    //             mkdir($directory, 0755, true); // 0755 is the default permission
    //         }

    //         // Save the image to the directory
    //         $imagePath = $directory . '/' . $imageName;
    //         file_put_contents($imagePath, base64_decode($image));

    //         // Save the record to the SiswaScanMasuk table
    //         $abs = new SiswaScanMasuk();
    //         $abs->id_siswa = $request->input('idsiswa');
    //         $abs->foto = $imageName;
    //         $abs->save();

    //         return redirect()->back()->with('success', 'Absen Masuk Berhasil!');
    //     }

    //     // Check if the current time is within the "Pulang" range
    //     if ($currentTime >= $pulangStart && $currentTime <= $pulangEnd) {
    //         // Check if id_siswa already exists in SiswaScanPulang
    //         $exists = SiswaScanPulang::where('id_siswa', $request->input('idsiswa'))
    //                                 ->whereDate('created_at', Carbon::today())
    //                                 ->exists();

    //         if ($exists) {
    //             return redirect()->back()->with('error', 'Sudah Scan Pulang Hari Ini');
    //         }

    //         // Set the directory for "Pulang" scans
    //         $directory = public_path('img/scan/pulang');

    //         // Create directory if it doesn't exist
    //         if (!file_exists($directory)) {
    //             mkdir($directory, 0755, true); // 0755 is the default permission
    //         }

    //         // Save the image to the directory
    //         $imagePath = $directory . '/' . $imageName;
    //         file_put_contents($imagePath, base64_decode($image));

    //         // Save the record to the SiswaScanPulang table
    //         $abs = new SiswaScanPulang();
    //         $abs->id_siswa = $request->input('idsiswa');
    //         $abs->foto = $imageName;
    //         $abs->save();

    //         return redirect()->back()->with('success', 'Absen Pulang Berhasil!');
    //     }

    //     // If the current time does not match any range, return an error message
    //     return redirect()->back()->with('error', 'Scan Gagal, Lakukan Scan Sesuai Jam Berlaku');
    // }

    public function store(Request $request)
    {
        // Set timezone to Asia/Jakarta (WIB - Western Indonesian Time)
        date_default_timezone_set('Asia/Jakarta');

        // Decode the image from base64 format
        $screenshot = $request->input('screenshot');
        $image = str_replace('data:image/png;base64,', '', $screenshot);
        $image = str_replace(' ', '+', $image);
        $imageName = 'scan_' . time() . '.png';

        // Get current time in Asia/Jakarta timezone
        $currentTime = Carbon::now('Asia/Jakarta');

        // Define time ranges in Asia/Jakarta timezone
        $masukStart = Carbon::createFromTime(0, 0, 0, 'Asia/Jakarta');
        $masukEnd = Carbon::createFromTime(7, 30, 0, 'Asia/Jakarta');
        $pulangStart = Carbon::createFromTime(13, 0, 0, 'Asia/Jakarta');
        $pulangEnd = Carbon::createFromTime(14, 0, 0, 'Asia/Jakarta');

        // Determine which table and directory to use based on current time
        if ($currentTime >= $masukStart && $currentTime <= $masukEnd) {
            $modelClass = SiswaScanMasuk::class;
            $scanType = 'Masuk';
            $directory = public_path('img/scan/masuk');
        } elseif ($currentTime >= $pulangStart && $currentTime <= $pulangEnd) {
            $modelClass = SiswaScanPulang::class;
            $scanType = 'Pulang';
            $directory = public_path('img/scan/pulang');
        } else {
            return redirect()->back()->with('error', 'Scan Gagal, Lakukan Scan Sesuai Jam Berlaku');
        }

        // Check if id_siswa already exists in the appropriate table for today
        $exists = $modelClass::where('id_siswa', $request->input('idsiswa'))
                             ->whereDate('created_at', Carbon::today())
                             ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Sudah Scan ' . $scanType . ' Hari Ini');
        }

        // Ensure directory exists, create if it doesn't
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Save the image to the directory using Laravel Storage
        $imagePath = $directory . '/' . $imageName;
        Storage::put($imagePath, base64_decode($image));

        // Save the record to the appropriate table within a database transaction
        DB::transaction(function () use ($request, $modelClass, $imageName) {
            $abs = new $modelClass();
            $abs->id_siswa = $request->input('idsiswa');
            $abs->foto = $imageName;
            $abs->save();
        });

        return redirect()->back()->with('success', 'Absen ' . $scanType . ' Berhasil!');
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
        $tapel = Tapel::where('status', 1)
            ->select('tahun_pelajaran.*')
            ->first();
        $semester = Semester::where('status', 1)
        ->select('semester.*')
        ->first();
        if ($tapel && $semester) {
            $counts = collect(['A', 'I', 'S'])->mapWithKeys(function ($keterangan) use ($id, $tapel, $semester) {
                return [
                    $keterangan => RekapAbsen::where('id_siswa', $id)
                        ->where('id_tapel', $tapel->id_tapel)
                        ->where('id_semester', $semester->id_semester)
                        ->where('keterangan', $keterangan)
                        ->count()
                ];
            });
        
            $a = $counts['A'];
            $i = $counts['I'];
            $s = $counts['S'];
        } else {
            $a = $i = $s = 0;
        }
        $harialpa = floor($a / 8);
        $hariijin = floor($i / 8);
        $harisakit = floor($s / 8);
        $jamalpa = floor($a % 8);
        $jamijin = floor($i % 8);
        $jamsakit = floor($s % 8);
        
        $siswa = Siswa::where('id_siswa', $id)
            ->select('siswa.*')
            ->first();
        $today = Carbon::now()->format('Y-m-d');
        $masuk = ScanMasuk::where('id_siswa', $id)
            ->whereDate('created_at', $today)
            ->select('siswa_scan_masuk.*')
            ->first();
        $pulang = ScanPulang::where('id_siswa', $id)
            ->whereDate('created_at', $today)
            ->select('siswa_scan_pulang.*')
            ->first();
        // Sum the biaya values
        $bayar = Biaya::sum('biaya');

        // Sum the jumlah values for the given student
        $pembayaran = Pembayaran::where('id_siswa', $id)
            ->sum('jumlah');

        // Calculate the total
        $total = $bayar - $pembayaran;

        // Format the total as Indonesian Rupiah
        $totalFormatted = 'Sisa Pembayaran : Rp. ' . number_format($total, 0, ',', '.');

        $pembayaran = Pembayaran::where('id_siswa', $id)
            ->select('pembayaran.*', 'guru.nama_guru')
            ->join('guru', 'guru.id_guru', '=', 'pembayaran.id_guru')
            ->get();
        return view('siswa.cek_absen.index', compact('siswa', 'tapel', 'semester', 'harialpa', 'hariijin', 'harisakit', 'jamalpa', 'jamijin', 'jamsakit', 'masuk', 'pulang', 'totalFormatted', 'total', 'pembayaran'));
    }
    // public function insertFromSiswa()
    // {
    //     // Set zona waktu Indonesia
    //     date_default_timezone_set('Asia/Jakarta');

    //     // Ambil semua id_siswa dari tabel siswa
    //     $siswaIds = DB::table('siswa')->pluck('id_siswa')->toArray();

    //     // Ambil id_siswa yang belum ada di tabel siswa_scan_pulang hari ini
    //     $today = Carbon::now()->format('Y-m-d');
    //     $siswaIdsAlpa = DB::table('siswa')
    //                     ->whereNotIn('id_siswa', function ($query) use ($today) {
    //                         $query->select('id_siswa')
    //                               ->from('siswa_scan_pulang')
    //                               ->whereDate('created_at', $today);
    //                     })
    //                     ->pluck('id_siswa')
    //                     ->toArray();

    //     // Insert ke dalam tabel siswa_alpa
    //     foreach ($siswaIdsAlpa as $id_siswa) {
    //         DB::table('siswa_alpa')->insert([
    //             'id_siswa' => $id_siswa,
    //             'created_at' => now(),
    //             'updated_at' => now()
    //         ]);
    //     }

    //     return response()->json([
    //         'message' => 'Data berhasil dimasukkan ke dalam tabel siswa_alpa.',
    //         'ids_inserted' => $siswaIdsAlpa
    //     ], 200);
    // }
    


// public function insertFromSiswa()
// {
//     // Set zona waktu Indonesia
//     date_default_timezone_set('Asia/Jakarta');

//     // Ambil semua id_siswa dari tabel siswa
//     $siswaIds = DB::table('siswa')->pluck('id_siswa')->toArray();

//     // Ambil id_siswa yang belum ada di tabel siswa_scan_pulang hari ini
//     $today = Carbon::now()->format('Y-m-d');
//     $siswaIdsAlpa = DB::table('siswa')
//                     ->whereNotIn('id_siswa', function ($query) use ($today) {
//                         $query->select('id_siswa')
//                               ->from('siswa_scan_pulang')
//                               ->whereDate('created_at', $today);
//                     })
//                     ->pluck('id_siswa')
//                     ->toArray();

//     // Insert ke dalam tabel siswa_alpa
//     foreach ($siswaIdsAlpa as $id_siswa) {
//         for ($jam_ke = 1; $jam_ke <= 8; $jam_ke++) {
//             DB::table('siswa_alpa')->insert([
//                 'id_siswa' => $id_siswa,
//                 'keterangan' => 'A',
//                 'jam_ke' => $jam_ke,
//                 'created_at' => now(),
//                 'updated_at' => now()
//             ]);
//         }
//     }

//     return response()->json([
//         'message' => 'Data berhasil dimasukkan ke dalam tabel siswa_alpa.',
//         'ids_inserted' => $siswaIdsAlpa
//     ], 200);
// }


public function insertFromSiswa()
{
    // Set zona waktu Indonesia
    date_default_timezone_set('Asia/Jakarta');

    // Ambil semua id_siswa dari tabel siswa
    $siswaIds = DB::table('siswa')->pluck('id_siswa')->toArray();
    $tapel = Tapel::where('status', 1)
    ->value('id_tapel');
    $semester = Semester::where('status', 1)
    ->value('id_semester');

    // Ambil id_siswa yang belum ada di tabel siswa_scan_pulang hari ini
    $today = Carbon::now()->format('Y-m-d');
    $siswaIdsAlpa = DB::table('siswa')
                    ->whereNotIn('id_siswa', function ($query) use ($today) {
                        $query->select('id_siswa')
                              ->from('siswa_scan_pulang')
                              ->whereRaw("DATE(created_at) = ?", [$today]); // Filter berdasarkan tanggal hari ini
                    })
                    ->orWhereNotIn('id_siswa', function ($query) use ($today) {
                        $query->select('id_siswa')
                              ->from('siswa_scan_masuk')
                              ->whereRaw("DATE(created_at) = ?", [$today]); // Filter berdasarkan tanggal hari ini
                    })
                    ->pluck('id_siswa')
                    ->toArray();

    // Insert ke dalam tabel siswa_alpa jika belum ada hari ini
    $dataToInsert = [];
    foreach ($siswaIdsAlpa as $id_siswa) {
        // Cek apakah id_siswa sudah ada di tabel siswa_alpa untuk hari ini
        $exists = DB::table('siswa_alpa')
                    ->where('id_siswa', $id_siswa)
                    ->whereDate('tanggal', $today)
                    ->exists();
                    
        if (!$exists) {
            for ($jam_ke = 1; $jam_ke <= 8; $jam_ke++) {
                $dataToInsert[] = [
                    'id_siswa' => $id_siswa,
                    'keterangan' => 'A',
                    'jam_ke' => $jam_ke,
                    'tanggal' => $today,
                    'id_tapel' => $tapel,
                    'id_semester' => $semester,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
    }

    // Insert data in batches
    $chunks = array_chunk($dataToInsert, 1000);
    foreach ($chunks as $chunk) {
        DB::table('siswa_alpa')->insert($chunk);
    }

    return redirect()->back()->with('success', 'Sukses Rekap!');
}



}

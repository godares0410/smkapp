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
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
    public function cekabsen()
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
        // Count jumlah siswa yang melakukan scan masuk dan scan pulang pada hari yang sama
        $countSiswa = SiswaScanMasuk::join('siswa_scan_pulang', 'siswa_scan_masuk.id_siswa', '=', 'siswa_scan_pulang.id_siswa')
        ->whereDate('siswa_scan_masuk.created_at', $today)
        ->whereDate('siswa_scan_pulang.created_at', $today)
        ->distinct('siswa_scan_masuk.id_siswa')
        ->count('siswa_scan_masuk.id_siswa');
        $tapel = Tapel::where('status', 1)
            ->select('tahun_pelajaran.*')
            ->first();
        $semester = Semester::where('status', 1)
        ->select('semester.*')
        ->first();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $siswaabs = SiswaAlpa::join('siswa', 'siswa_alpa.id_siswa', '=', 'siswa.id_siswa')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')  // Jika perlu menghubungkan tabel kelas
        ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')  // Jika perlu menghubungkan tabel jurusan
        ->select(
            'siswa.id_siswa',
            'siswa.nama_siswa',
            'siswa.id_kelas',
            'siswa.id_jurusan',
            'kelas.nama_kelas',   // Menambahkan nama kelas
            'jurusan.nama_jurusan',  // Menambahkan nama jurusan
            'siswa_alpa.keterangan'  // Menambahkan nama jurusan
            )
            ->whereDate('siswa_alpa.created_at', $today) // Menambahkan filter untuk hari ini
            ->groupBy(
                'siswa.id_siswa',
                'siswa.nama_siswa',
                'siswa.id_kelas',
                'siswa.id_jurusan',
                'kelas.nama_kelas',
                'jurusan.nama_jurusan',
                'siswa_alpa.keterangan'  // Menambahkan nama jurusan
        )
        ->orderBy('siswa.nama_siswa', 'asc')
        ->get();
        $jumlahSiswa = Siswa::count();
         // Cek status kegiatan 'pkl'
        $jumlahSiswaJPKL = Siswa::where('id_kelas', '!=', 3)->count();
         $kegiatanStatus = DB::table('kegiatan')
         ->where('nama_kegiatan', 'pkl')
         ->value('status');
        // Insert ke dalam tabel siswa_alpa berdasarkan status kegiatan
        if ($kegiatanStatus === 0) {
            $tidakMasuk = $jumlahSiswa - $countSiswa;
        }
        elseif ($kegiatanStatus === 1) {
            $tidakMasuk = $jumlahSiswaJPKL - $countSiswa;
        }
        return view('absen.cekabsen', compact('sm', 'sp', 'tapel', 'semester', 'countSiswa', 'tidakMasuk', 'kelas', 'jurusan', 'siswaabs'));
    }
    public function fotoabsen()
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
        // Count jumlah siswa yang melakukan scan masuk dan scan pulang pada hari yang sama
        $countSiswa = SiswaScanMasuk::join('siswa_scan_pulang', 'siswa_scan_masuk.id_siswa', '=', 'siswa_scan_pulang.id_siswa')
        ->whereDate('siswa_scan_masuk.created_at', $today)
        ->whereDate('siswa_scan_pulang.created_at', $today)
        ->distinct('siswa_scan_masuk.id_siswa')
        ->count('siswa_scan_masuk.id_siswa');
        $tapel = Tapel::where('status', 1)
            ->select('tahun_pelajaran.*')
            ->first();
        $semester = Semester::where('status', 1)
        ->select('semester.*')
        ->first();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $siswaabs = SiswaAlpa::join('siswa', 'siswa_alpa.id_siswa', '=', 'siswa.id_siswa')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')  // Jika perlu menghubungkan tabel kelas
        ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')  // Jika perlu menghubungkan tabel jurusan
        ->select(
            'siswa.id_siswa',
            'siswa.nama_siswa',
            'siswa.id_kelas',
            'siswa.id_jurusan',
            'kelas.nama_kelas',   // Menambahkan nama kelas
            'jurusan.nama_jurusan',  // Menambahkan nama jurusan
            'siswa_alpa.keterangan'  // Menambahkan nama jurusan
            )
            ->whereDate('siswa_alpa.created_at', $today) // Menambahkan filter untuk hari ini
            ->groupBy(
                'siswa.id_siswa',
                'siswa.nama_siswa',
                'siswa.id_kelas',
                'siswa.id_jurusan',
                'kelas.nama_kelas',
                'jurusan.nama_jurusan',
                'siswa_alpa.keterangan'  // Menambahkan nama jurusan
        )
        ->orderBy('siswa.nama_siswa', 'asc')
        ->get();
        $jumlahSiswa = Siswa::count();
         // Cek status kegiatan 'pkl'
        $jumlahSiswaJPKL = Siswa::where('id_kelas', '!=', 3)->count();
         $kegiatanStatus = DB::table('kegiatan')
         ->where('nama_kegiatan', 'pkl')
         ->value('status');
        // Insert ke dalam tabel siswa_alpa berdasarkan status kegiatan
        if ($kegiatanStatus === 0) {
            $tidakMasuk = $jumlahSiswa - $countSiswa;
        }
        elseif ($kegiatanStatus === 1) {
            $tidakMasuk = $jumlahSiswaJPKL - $countSiswa;
        }
        return view('absen.fotoabsen', compact('sm', 'sp', 'tapel', 'semester', 'countSiswa', 'tidakMasuk', 'kelas', 'jurusan', 'siswaabs'));
    }
    
    public function getScanMasukData()
    {
        $today = Carbon::now()->format('Y-m-d');
    
        $sm = SiswaScanMasuk::select('siswa.nama_siswa', 'siswa_scan_masuk.*', 'siswa.foto as fotosis', 'kelas.nama_kelas', 'jurusan.kode_jurusan', 'siswa_scan_masuk.created_at as msk')
            ->join('siswa', 'siswa.id_siswa', '=', 'siswa_scan_masuk.id_siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
            ->whereDate('siswa_scan_masuk.created_at', $today)
            ->orderBy('id_siswa_scan_masuk', 'desc')
            ->get()
            ->map(function ($item) {
                // Convert the timestamp to Asia/Jakarta timezone
                $item->msk = Carbon::parse($item->msk)->setTimezone('Asia/Jakarta')->format('H:i:s');
                return $item;
            });
    
        return response()->json($sm);
    }
    public function getCountMasukx()
    {
        $today = Carbon::now()->format('Y-m-d');

        // Menghitung jumlah siswa yang sudah melakukan scan masuk pada kelas tertentu
        $count_scan_masuk = SiswaScanMasuk::whereDate('siswa_scan_masuk.created_at', $today)
            ->join('siswa', 'siswa.id_siswa', '=', 'siswa_scan_masuk.id_siswa')
            ->where('siswa.id_kelas', 1) // Sesuaikan dengan id_kelas yang Anda inginkan
            ->count();

        // Menghitung jumlah total siswa pada kelas tertentu
        $total_siswa = Siswa::where('id_kelas', 1) // Sesuaikan dengan id_kelas yang Anda inginkan
            ->count();

        // Menghitung jumlah siswa yang belum melakukan scan masuk
        $count_belum_scan_masuk = $total_siswa - $count_scan_masuk;

        return response()->json([
                        'count' => $count_belum_scan_masuk,
                        'masuk' => $count_scan_masuk]);
    }
    public function getCountMasukxi()
    {
        $today = Carbon::now()->format('Y-m-d');

        // Menghitung jumlah siswa yang sudah melakukan scan masuk pada kelas tertentu
        $count_scan_masuk = SiswaScanMasuk::whereDate('siswa_scan_masuk.created_at', $today)
            ->join('siswa', 'siswa.id_siswa', '=', 'siswa_scan_masuk.id_siswa')
            ->where('siswa.id_kelas', 2) // Sesuaikan dengan id_kelas yang Anda inginkan
            ->count();

        // Menghitung jumlah total siswa pada kelas tertentu
        $total_siswa = Siswa::where('id_kelas', 2) // Sesuaikan dengan id_kelas yang Anda inginkan
            ->count();

        // Menghitung jumlah siswa yang belum melakukan scan masuk
        $count_belum_scan_masuk = $total_siswa - $count_scan_masuk;

        return response()->json([
                        'count' => $count_belum_scan_masuk,
                        'masuk' => $count_scan_masuk]);
    }
    public function getCountPulangx()
    {
        $today = Carbon::now()->format('Y-m-d');

        // Menghitung jumlah siswa yang sudah melakukan scan pulang pada kelas tertentu
        $count_scan_pulang = SiswaScanPulang::whereDate('siswa_scan_pulang.created_at', $today)
            ->join('siswa', 'siswa.id_siswa', '=', 'siswa_scan_pulang.id_siswa')
            ->where('siswa.id_kelas', 1) // Sesuaikan dengan id_kelas yang Anda inginkan
            ->count();

        // Menghitung jumlah total siswa pada kelas tertentu
        $total_siswa = Siswa::where('id_kelas', 1) // Sesuaikan dengan id_kelas yang Anda inginkan
            ->count();

        // Menghitung jumlah siswa yang belum melakukan scan pulang
        $count_belum_scan_pulang = $total_siswa - $count_scan_pulang;

        return response()->json([
                        'count' => $count_belum_scan_pulang,
                        'pulang' => $count_scan_pulang]);
    }
    public function getCountPulangxi()
    {
        $today = Carbon::now()->format('Y-m-d');

        // Menghitung jumlah siswa yang sudah melakukan scan pulang pada kelas tertentu
        $count_scan_pulang = SiswaScanPulang::whereDate('siswa_scan_pulang.created_at', $today)
            ->join('siswa', 'siswa.id_siswa', '=', 'siswa_scan_pulang.id_siswa')
            ->where('siswa.id_kelas', 2) // Sesuaikan dengan id_kelas yang Anda inginkan
            ->count();

        // Menghitung jumlah total siswa pada kelas tertentu
        $total_siswa = Siswa::where('id_kelas', 2) // Sesuaikan dengan id_kelas yang Anda inginkan
            ->count();

        // Menghitung jumlah siswa yang belum melakukan scan pulang
        $count_belum_scan_pulang = $total_siswa - $count_scan_pulang;

        return response()->json([
                        'count' => $count_belum_scan_pulang,
                        'pulang' => $count_scan_pulang]);
    }
    public function getScanPulangData()
    {
        $today = Carbon::now()->format('Y-m-d');
    
        $sm = SiswaScanPulang::select('siswa.nama_siswa', 'siswa_scan_pulang.*', 'siswa.foto as fotosis', 'kelas.nama_kelas', 'jurusan.kode_jurusan', 'siswa_scan_pulang.created_at as plg')
            ->join('siswa', 'siswa.id_siswa', '=', 'siswa_scan_pulang.id_siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
            ->whereDate('siswa_scan_pulang.created_at', $today)
            ->orderBy('id_siswa_scan_pulang', 'desc')
            ->get()
            ->map(function ($item) {
                // Convert the timestamp to Asia/Jakarta timezone
                $item->plg = Carbon::parse($item->plg)->setTimezone('Asia/Jakarta')->format('H:i:s');
                return $item;
            });
    
        return response()->json($sm);
    }

    public function pklmasuk()
    {
        $idSiswa = Auth::guard('siswa')->user()->id_siswa;
        return view('absen.pklmasuk', compact('idSiswa'));
    }
    public function pklpulang()
    {
        $idSiswa = Auth::guard('siswa')->user()->id_siswa;
        return view('absen.pklpulang', compact('idSiswa'));
    }

    public function store(Request $request)
    {
        // Decode the image from base64 format
        $screenshot = $request->input('screenshot');
        $image = str_replace('data:image/png;base64,', '', $screenshot);
        $image = str_replace(' ', '+', $image);
        $imageName = 'scan_' . time() . '.png';
    
        // Get the current time in Asia/Jakarta timezone
        $currentTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
    
        // Define the time ranges in Asia/Jakarta timezone
        $masukStart = new \DateTime('06:00', new \DateTimeZone('Asia/Jakarta'));
        $masukEnd = new \DateTime('07:45', new \DateTimeZone('Asia/Jakarta'));
        $pulangStart = new \DateTime('09:00', new \DateTimeZone('Asia/Jakarta'));
        $pulangEnd = new \DateTime('14:30', new \DateTimeZone('Asia/Jakarta'));
    
        // Check if it's "Masuk" or "Pulang" based on current time
        $isMasukTime = ($currentTime >= $masukStart && $currentTime <= $masukEnd);
        $isPulangTime = ($currentTime >= $pulangStart && $currentTime <= $pulangEnd);
    
        if (!$isMasukTime && !$isPulangTime) {
            return response()->json(['error' => 'Scan Gagal, Lakukan Scan Sesuai Jam Berlaku']);
        }
    
        // Check if id_siswa exists in the siswa table
        $siswaExists = DB::table('siswa')
                        ->where('id_siswa', $request->input('idsiswa'))
                        ->exists();
    
        if (!$siswaExists) {
            return response()->json(['errorz' => 'Siswa tidak valid']);
        }
    
        // Check if id_siswa already exists in siswa_scan_masuk today
        $existsMasuk = DB::table('siswa_scan_masuk')
                        ->where('id_siswa', $request->input('idsiswa'))
                        ->whereDate('created_at', Carbon::today())
                        ->exists();
    
        // Handle the case if already scanned Masuk
        if ($existsMasuk && $isMasukTime) {
            return response()->json(['error' => 'Sudah Scan Masuk Hari Ini']);
        }
    
        // Check if id_siswa already exists in siswa_scan_pulang today
        $existsPulang = DB::table('siswa_scan_pulang')
                        ->where('id_siswa', $request->input('idsiswa'))
                        ->whereDate('created_at', Carbon::today())
                        ->exists();
    
        // Handle the case if already scanned Pulang
        if ($existsPulang && $isPulangTime) {
            return response()->json(['error' => 'Sudah Scan Pulang Hari Ini']);
        }
    
        // Set the directory for scans
        $folder = $isMasukTime ? 'masuk' : 'pulang';
        $directory = public_path('img/scan/' . $folder);
    
        // Create directory if it doesn't exist
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true); // 0755 is the default permission
        }
    
        // Save the image to the directory
        $imagePath = $directory . '/' . $imageName;
        file_put_contents($imagePath, base64_decode($image));
    
        // Save the record to the respective table using transaction
        DB::beginTransaction();
    
        try {
            $table = $isMasukTime ? 'siswa_scan_masuk' : 'siswa_scan_pulang';
    
            DB::table($table)->insert([
                'id_siswa' => $request->input('idsiswa'),
                'foto' => $imageName,
                'created_at' => now(),  // assuming timestamps are managed by Eloquent/Query Builder
                'updated_at' => now(),
            ]);
    
            DB::commit();
    
            $message = $isMasukTime ? 'Absen Masuk Berhasil!' : 'Absen Pulang Berhasil!';
            return response()->json(['success' => $message]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Gagal menyimpan absen, coba lagi.']);
        }
    }
    
    public function pklstoremasuk(Request $request)
    {
    // Decode the image from base64 format
    $screenshot = $request->input('screenshot');
    $image = str_replace('data:image/png;base64,', '', $screenshot);
    $image = str_replace(' ', '+', $image);
    $imageName = 'scan_' . time() . '.png';

    // Path to the directory
    $directory = public_path('img/scan/masuk');

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

    return redirect()->back()->with('success', 'Absen Berhasil!');
    // return redirect()->route('siswa.dashboard')->with('success', 'Data Ujian Berhasil Ditambahkan.');
    }


    public function pklstorepulang(Request $request)
    {
    // Decode the image from base64 format
    $screenshot = $request->input('screenshot');
    $image = str_replace('data:image/png;base64,', '', $screenshot);
    $image = str_replace(' ', '+', $image);
    $imageName = 'scan_' . time() . '.png';

    // Path to the directory
    $directory = public_path('img/scan/pulang');

    // Create directory if it doesn't exist
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true); // 0755 is the default permission
    }

    // Save the image to the directory
    $imagePath = $directory . '/' . $imageName;
    file_put_contents($imagePath, base64_decode($image));

    // Use Carbon to get the current time in Jakarta
    $jakartaTime = Carbon::now('Asia/Jakarta');

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
    //     $tapel = Tapel::where('status', 1)
    //     ->value('id_tapel');
    //     $semester = Semester::where('status', 1)
    //     ->value('id_semester');

    //     // Ambil id_siswa yang belum ada di tabel siswa_scan_pulang hari ini
    //     $today = Carbon::now()->format('Y-m-d');
    //     $siswaIdsAlpa = DB::table('siswa')
    //                     ->whereNotIn('id_siswa', function ($query) use ($today) {
    //                         $query->select('id_siswa')
    //                             ->from('siswa_scan_pulang')
    //                             ->whereRaw("DATE(created_at) = ?", [$today]); // Filter berdasarkan tanggal hari ini
    //                     })
    //                     ->orWhereNotIn('id_siswa', function ($query) use ($today) {
    //                         $query->select('id_siswa')
    //                             ->from('siswa_scan_masuk')
    //                             ->whereRaw("DATE(created_at) = ?", [$today]); // Filter berdasarkan tanggal hari ini
    //                     })
    //                     ->pluck('id_siswa')
    //                     ->toArray();

    //     // Insert ke dalam tabel siswa_alpa jika belum ada hari ini
    //     $dataToInsert = [];
    //     foreach ($siswaIdsAlpa as $id_siswa) {
    //         // Cek apakah id_siswa sudah ada di tabel siswa_alpa untuk hari ini
    //         $exists = DB::table('siswa_alpa')
    //                     ->where('id_siswa', $id_siswa)
    //                     ->whereDate('tanggal', $today)
    //                     ->exists();
                        
    //         if (!$exists) {
    //             for ($jam_ke = 1; $jam_ke <= 8; $jam_ke++) {
    //                 $dataToInsert[] = [
    //                     'id_siswa' => $id_siswa,
    //                     'keterangan' => 'A',
    //                     'jam_ke' => $jam_ke,
    //                     'tanggal' => $today,
    //                     'id_tapel' => $tapel,
    //                     'id_semester' => $semester,
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ];
    //             }
    //         }
    //     }

    //     // Insert data in batches
    //     $chunks = array_chunk($dataToInsert, 1000);
    //     foreach ($chunks as $chunk) {
    //         DB::table('siswa_alpa')->insert($chunk);
    //     }

    //     return redirect()->back()->with('success', 'Sukses Rekap!');
    // }
    public function insertFromSiswa()
    {
        // Set zona waktu Indonesia
        date_default_timezone_set('Asia/Jakarta');

        // Ambil semua id_siswa dari tabel siswa
        $siswaIds = DB::table('siswa')->pluck('id_siswa')->toArray();
        $tapel = Tapel::where('status', 1)->value('id_tapel');
        $semester = Semester::where('status', 1)->value('id_semester');

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

        // Cek status kegiatan 'pkl'
        $kegiatanStatus = DB::table('kegiatan')
                            ->where('nama_kegiatan', 'pkl')
                            ->value('status');

        // Insert ke dalam tabel siswa_alpa berdasarkan status kegiatan
        if ($kegiatanStatus === 1) {
            // Jika status kegiatan = 1, lakukan pengecualian untuk id_kelas = 3
            $dataToInsert = [];
            foreach ($siswaIdsAlpa as $id_siswa) {
                // Cek id_kelas (misalnya, ambil dari tabel siswa atau tabel lain yang sesuai)
                $id_kelas = DB::table('siswa')
                            ->where('id_siswa', $id_siswa)
                            ->value('id_kelas');

                // Lanjutkan jika id_kelas bukan 3
                if ($id_kelas != 3) {
                    // Cek apakah id_siswa sudah ada di tabel siswa_alpa untuk hari ini
                    $exists = DB::table('siswa_alpa')
                                ->where('id_siswa', $id_siswa)
                                ->whereDate('created_at', $today)
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
            }

            // Insert data in batches
            $chunks = array_chunk($dataToInsert, 1000);
            foreach ($chunks as $chunk) {
                DB::table('siswa_alpa')->insert($chunk);
            }

            return redirect()->back()->with('success', 'Sukses Rekap!');
        } elseif ($kegiatanStatus === 0) {
            // Jika status kegiatan = 0, insert semua tanpa pengecualian
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
        } else {
            return redirect()->back()->with('error', 'Status kegiatan tidak dikenali.');
        }
    }

    public function getScanMasukDataPKL(Request $request)
{
    $today = Carbon::now()->format('Y-m-d');
    $since = $request->input('since', Carbon::now()->subDay()->timestamp); // Default to 24 hours ago

    $sm = SiswaScanMasuk::select('siswa.nama_siswa', 'siswa_scan_masuk.*', 'siswa.foto as fotosis', 'kelas.nama_kelas', 'jurusan.kode_jurusan', 'siswa_scan_masuk.created_at as msk')
        ->join('siswa', 'siswa.id_siswa', '=', 'siswa_scan_masuk.id_siswa')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
        ->whereDate('siswa_scan_masuk.created_at', $today)
        ->where('siswa_scan_masuk.created_at', '>', Carbon::createFromTimestamp($since)->toDateTimeString())
        ->orderBy('id_siswa_scan_masuk', 'desc')
        ->get()
        ->map(function ($item) {
            // Convert the timestamp to Asia/Jakarta timezone
            $item->msk = Carbon::parse($item->msk)->setTimezone('Asia/Jakarta')->format('H:i:s');
            return $item;
        });

    return response()->json($sm);
}
public function getScanPulangDataPKL(Request $request)
{
    $today = Carbon::now()->format('Y-m-d');
    $since = $request->input('since', Carbon::now()->subDay()->timestamp); // Default to 24 hours ago

    $sm = SiswaScanPulang::select('siswa.nama_siswa', 'siswa_scan_pulang.*', 'siswa.foto as fotosis', 'kelas.nama_kelas', 'jurusan.kode_jurusan', 'siswa_scan_pulang.created_at as plg')
        ->join('siswa', 'siswa.id_siswa', '=', 'siswa_scan_pulang.id_siswa')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
        ->whereDate('siswa_scan_pulang.created_at', $today)
        ->where('siswa_scan_pulang.created_at', '>', Carbon::createFromTimestamp($since)->toDateTimeString())
        ->orderBy('id_siswa_scan_pulang', 'desc')
        ->get()
        ->map(function ($item) {
            // Convert the timestamp to Asia/Jakarta timezone
            $item->plg = Carbon::parse($item->plg)->setTimezone('Asia/Jakarta')->format('H:i:s');
            return $item;
        });

    return response()->json($sm);
}

}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Soal;
use App\Models\Siswa;
use App\Models\Token;
use App\Models\Ujian;
use App\Models\BankSoal;
use App\Models\BankUjian;
use App\Models\SiswaSesi;
use App\Models\SiswaMulai;
use App\Models\SiswaNilai;
use App\Models\SiswaUjian;
use App\Models\JadwalUjian;
use App\Models\AlokasiWaktu;
use App\Models\SesiJadwalUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class SiswasController extends Controller
{
    public function index()
    {
        $kelas = Auth::guard('siswa')->user()->id_kelas;
        $jurusan = Auth::guard('siswa')->user()->id_jurusan;
        $idSiswa = Auth::guard('siswa')->user()->id_siswa;

        $sesi = SiswaSesi::where('id_siswa', $idSiswa)
            ->select('id_sesi')
            ->first();

        $today = Carbon::now();
        // $ujian = JadwalUjian::select('jadwal_ujian.*', 'mapel.nama_mapel', 'kelas.nama_kelas', 'bank_ujian.*', 'sesi_jadwal_ujian.id_jadwal_ujian as ujian_id', 'sesi_jadwal_ujian.id_sesi', 'sesi_jadwal_ujian.jam_mulai', 'sesi_jadwal_ujian.jam_selesai', 'sesi.nama_sesi', 'jenis_ujian.id_jenis')
        //     ->join('bank_ujian', 'bank_ujian.id_bank_ujian', '=', 'jadwal_ujian.id_bank_ujian')
        //     ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
        //     ->join('kelas', 'kelas.id_kelas', '=', 'bank_ujian.id_kelas')
        //     ->join('jenis_ujian', 'jenis_ujian.id_jenis', '=', 'bank_ujian.id_jenis')
        //     ->join('sesi_jadwal_ujian', 'sesi_jadwal_ujian.id_jadwal_ujian', '=', 'jadwal_ujian.id_jadwal_ujian')
        //     ->join('sesi', 'sesi_jadwal_ujian.id_sesi', '=', 'sesi.id_sesi')
        //     ->where('bank_ujian.id_kelas', $kelas)
        //     ->get();


            $ujian = JadwalUjian::select('jadwal_ujian.*', 'mapel.nama_mapel', 'kelas.nama_kelas', 'bank_ujian.*', 'sesi_jadwal_ujian.id_jadwal_ujian as ujian_id', 'sesi_jadwal_ujian.id_sesi', 'alokasi_waktu.jam_mulai', 'alokasi_waktu.jam_selesai', 'sesi.nama_sesi', 'jenis_ujian.id_jenis')
            ->join('bank_ujian', 'bank_ujian.id_bank_ujian', '=', 'jadwal_ujian.id_bank_ujian')
            ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
            ->join('kelas', 'kelas.id_kelas', '=', 'bank_ujian.id_kelas')
            ->join('jenis_ujian', 'jenis_ujian.id_jenis', '=', 'bank_ujian.id_jenis')
            ->join('sesi_jadwal_ujian', 'sesi_jadwal_ujian.id_jadwal_ujian', '=', 'jadwal_ujian.id_jadwal_ujian')
            ->join('sesi', 'sesi_jadwal_ujian.id_sesi', '=', 'sesi.id_sesi')
            ->join('alokasi_waktu', 'sesi_jadwal_ujian.id_alokasi_waktu', '=', 'alokasi_waktu.id_alokasi_waktu')
            ->where('bank_ujian.id_kelas', $kelas)
            ->get();


        $kerjakan = SiswaUjian::where('id_siswa', $idSiswa)->first();
        $nilai = SiswaNilai::where('id_siswa', $idSiswa)->first();

        return view('siswa.ujian.indux', compact('ujian', 'kerjakan', 'sesi', 'nilai'));
    }
    public function dashboard()
    {
        return view('siswa.dashboard');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $tokenInput = $request->input('tokenInput');
        $token = Token::where('token', $tokenInput)->first();
        // $mula = $request->input('siswa_mulai');

        if ($token) {
            $idSiswa = Auth::guard('siswa')->user()->id_siswa;
            $idBankSoal = $request->input('idbank');
            $idUjian = $request->input('idUjian');
            $jumlahSoal = $request->input('jumlahSoal');
            $acakSoal = $request->input('acakSoal');
            // $idBank 

            // Convert JSON string to an array
            $idBankSoalArray = json_decode($idBankSoal);

            // Retrieve soal based on conditions
            $soalQuery = DB::table('soal')
                ->where('id_bank_soal', $idBankSoalArray);

            if ($acakSoal == 1) {
                $soalQuery->inRandomOrder();
            }

            $soalRecords = $soalQuery->take($jumlahSoal)->get();

            // Create an array to store multiple records
            $siswaData = [];

            // Add records to the array
            foreach ($soalRecords as $soal) {
                $siswaData[] = [
                    'id_jadwal_ujian' => $idUjian,
                    'id_siswa' => $idSiswa,
                    'id_soal' => $soal->id_soal,
                    // 'kunci' => $soal->jawaban,
                ];
            }
            // Save all records in the array to the database
            SiswaUjian::insert($siswaData);

            $mulai = new SiswaMulai;
            $mulai->id_jadwal_ujian = $idUjian;
            $mulai->id_siswa = $idSiswa;
            // $mulai->mulai = $request->mula;
            $mulai->save();

            $kode = Crypt::encryptString($idUjian);
            return redirect('/detail/' . $kode)->with('sukses', 'Data berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Token Salah!');
        }
    }
    public function mengerjakan(Request $request)
    {
        // Dapatkan id_siswa dari user yang login
        $idSiswa = Auth::guard('siswa')->user()->id_siswa;
        // $idUjian = decrypt($encryptedIdUjian);
        // Dapatkan id_ujian dari request
        $idUjian = $request->input('id_ujian');

        // Ambil id_soal dari tabel siswa_ujian berdasarkan id_ujian dan id_siswa
        $idSoals = SiswaUjian::where('id_jadwal_ujian', $idUjian)
            ->where('id_siswa', $idSiswa)
            ->orderByDesc('id_siswa_ujian')
            ->get();
        $suul = JadwalUjian::where('id_jadwal_ujian', $idUjian)
        ->value('id_bank_ujian');
        $bs = BankUjian::select('id_bank_soal')
        ->get();

        // Gunakan $idSoals untuk mengambil data dari tabel soal atau tabel lainnya
        $soal = Soal::join('siswa_ujian', 'soal.id_soal', '=', 'siswa_ujian.id_soal')
            ->whereIn('soal.id_soal', $idSoals->pluck('id_soal'))
            ->where('siswa_ujian.id_siswa', $idSiswa)
            ->get(['soal.*', 'siswa_ujian.jawaban as soal_jawaban']);
        $ujian = BankUjian::where('id_bank_ujian', $suul)
        ->join('mapel', 'bank_ujian.id_mapel', '=', 'mapel.id_mapel')
        // ->join('bank_soal', 'bank_ujian.id_bank_soal', '=', 'bank_soal.id_bank_soal')
        ->select('bank_ujian.acak_opsi', 'bank_ujian.jumlah_opsi', 'mapel.nama_mapel', 'mapel.kode_mapel', 'bank_ujian.id_bank_soal')->first();
        $idUj = JadwalUjian::where('id_jadwal_ujian', $idUjian)
            ->value('id_jadwal_ujian');
        return view('siswa.kerjakan.index', compact('soal', 'ujian', 'idUj'))->with('success', 'Berhasil Masuk');
    }
    public function update(Request $request)

    {
        // Ambil data dari request

        $encryptedJawaban = $request->input('jawaban');



        $idSoal = $request->input('id_soal');
        $jawaban = Crypt::decrypt($encryptedJawaban);

        // Ambil id siswa dari auth
        $idSiswa = auth('siswa')->user()->id_siswa;

        $soal = Soal::find($idSoal);
        $idUjian = SiswaUjian::where('id_siswa', $idSiswa)
            ->where('id_soal', $idSoal)
            ->value('id_jadwal_ujian');
        $jmlh = SiswaUjian::where('id_siswa', $idSiswa)
            ->where('id_jadwal_ujian', $idUjian)
            ->count();
        if ($soal) {
            // Memeriksa apakah $jawaban cocok dengan kolom pil_a
            if ($jawaban == $soal->pil_a) {
                $jawaban = 'A';
            }
            // Memeriksa apakah $jawaban cocok dengan kolom pil_b
            elseif ($jawaban == $soal->pil_b) {
                $jawaban = 'B';
            }
            // Menambahkan kondisi lain untuk pil_c, pil_d, dan pil_e jika diperlukan
            elseif ($jawaban == $soal->pil_c) {
                $jawaban = 'C';
            } elseif ($jawaban == $soal->pil_d) {
                $jawaban = 'D';
            } elseif ($jawaban == $soal->pil_e) {
                $jawaban = 'E';
            }
            // Update jawaban di tabel siswa_ujian
            SiswaUjian::where('id_siswa', $idSiswa)
                ->where('id_soal', $idSoal)
                ->update(['jawaban' => $jawaban]);
            // Ambil kunci jawaban dari kolom kunci pada tabel soal
            $kunciJawaban = $soal->jawaban; // Perubahan disini
            $nilai = 100 / $jmlh;
            // Periksa apakah jawaban yang baru saja diupdate sama dengan kunci
            if ($jawaban == $kunciJawaban) {
                // Jika jawaban benar, update nilai kolom point menjadi 20
                SiswaUjian::where('id_siswa', $idSiswa)
                    ->where('id_soal', $idSoal)
                    ->update(['point' => $nilai]);
            } else {
                // Jika jawaban salah, nilai kolom point tetap 0 (atau sesuaikan dengan kebutuhan Anda)
                SiswaUjian::where('id_siswa', $idSiswa)
                    ->where('id_soal', $idSoal)
                    ->update(['point' => 0]);
            }
        }
    }
    public function ragu(Request $request)
    {
    }

    public function updateStatus(Request $request)
    {
        // Mendapatkan ID siswa yang sedang login
        $idSiswa = auth('siswa')->user()->id_siswa;

        try {
            // Mengupdate kolom status pada tabel siswa menjadi 0
            Siswa::where('id_siswa', $idSiswa)->update(['status' => 0]);
            // Logout siswa
            auth('siswa')->logout();

            return response()->json(['success' => true, 'message' => 'Akun Anda diblokir']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update status']);
        }
    }
    public function detail($kode)
    {
        $idUjian = Crypt::decryptString($kode);
        $nama = JadwalUjian::where('id_jadwal_ujian', $idUjian)
            ->join('bank_ujian', 'jadwal_ujian.id_bank_ujian', '=', 'bank_ujian.id_bank_ujian')
            ->join('jenis_ujian', 'bank_ujian.id_jenis', '=', 'jenis_ujian.id_jenis')
            ->select('jenis_ujian.nama_ujian')
            ->first();
        $ujian = JadwalUjian::select('jadwal_ujian.*', 'mapel.nama_mapel', 'kelas.nama_kelas')
            ->join('bank_ujian', 'bank_ujian.id_bank_ujian', '=', 'jadwal_ujian.id_bank_ujian')
            ->join('mapel', 'mapel.id_mapel', '=', 'bank_ujian.id_mapel')
            ->join('kelas', 'kelas.id_kelas', '=', 'bank_ujian.id_kelas')
            ->where('jadwal_ujian.id_jadwal_ujian', $idUjian)
            ->get();
        return view('siswa.ujian.detail', compact('ujian', 'nama'));
    }
    public function selesai(Request $request)
    {
        try {
            $id_siswa = Auth::guard('siswa')->user()->id_siswa;
            $id_kelas = Auth::guard('siswa')->user()->id_kelas;
            $id_jurusan = Auth::guard('siswa')->user()->id_jurusan;
            $id_jadwal = $request->input('idUj');

            $totalPoint = SiswaUjian::where('id_jadwal_ujian', $id_jadwal)
                ->where('id_siswa', $id_siswa)
                ->sum('point');
            $mapel = JadwalUjian::where('id_jadwal_ujian', $id_jadwal)
                ->join('bank_ujian', 'jadwal_ujian.id_bank_ujian', '=', 'bank_ujian.id_bank_ujian')
                ->join('jenis_ujian', 'bank_ujian.id_jenis', '=', 'jenis_ujian.id_jenis')
                ->join('mapel', 'bank_ujian.id_mapel', '=', 'mapel.id_mapel')
                ->select('mapel.id_mapel', 'jenis_ujian.id_jenis')
                ->first();

            // Pastikan $mapel tidak null sebelum digunakan
            if (!$mapel) {
                throw new \Exception('Jadwal ujian tidak valid.');
            }

            $nilai = new SiswaNilai;
            $nilai->id_siswa = $id_siswa;
            $nilai->id_kelas = $id_kelas;
            $nilai->id_jurusan = $id_jurusan;
            $nilai->id_jenis = $mapel->id_jenis;
            $nilai->id_mapel = $mapel->id_mapel;
            $nilai->nilai = $totalPoint;
            $nilai->save();


            SiswaUjian::where('id_jadwal_ujian', $id_jadwal)
            ->where('id_siswa', $id_siswa)
            ->delete();
            SiswaMulai::where('id_jadwal_ujian', $id_jadwal)
            ->where('id_siswa', $id_siswa)
            ->delete();

            // Tambahkan pengalihan ke halaman tujuan setelah menyimpan nilai
            return redirect('/siswas');
        } catch (\Exception $e) {
            // Tangani error, misalnya, dapatkan pesan kesalahan dan tampilkan
            return back()->withError($e->getMessage())->withInput();
        }
    }
}

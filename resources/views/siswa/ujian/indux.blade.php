@extends('layout.master')
@section('title')
    Assesmen
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('assesmen', 'active')
@section('assesmen-active', 'active')

@section('badge')
    @parent
    <li class="active">{{ ucwords($title) }}</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Title</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: '{{ session('error') }}',
                            showConfirmButton: false,
                            timer: 2500 // Menutup pesan dalam 1 detik (1000ms)
                        });
                    </script>
                @endif
                <div class="row">
                    @php
                        $today = \Carbon\Carbon::now()->timezone('Asia/Jakarta');
                    @endphp
                    @foreach ($ujian as $data)
                        {{-- @if (in_array(Auth::guard('siswa')->user()->id_jurusan, json_decode($data->id_jurusan))) --}}
                        @php
                            $jm_start = \App\Models\SesiJadwalUjian::where('sesi_jadwal_ujian.id_sesi', $sesi->id_sesi)
                                ->where('sesi_jadwal_ujian.id_jadwal_ujian', $data->id_jadwal_ujian)
                                ->join('alokasi_waktu', 'alokasi_waktu.id_alokasi_waktu', '=', 'sesi_jadwal_ujian.id_alokasi_waktu')
                                ->select('sesi_jadwal_ujian.id_sesi', 'sesi_jadwal_ujian.id_jadwal_ujian', 'alokasi_waktu.jam_mulai')
                                ->first();
                        @endphp
                        {{-- @dd($data->id_sesi) --}}
                        @if (in_array(Auth::guard('siswa')->user()->id_jurusan, json_decode($data->id_jurusan)) &&
                                $data->id_jadwal_ujian == $data->ujian_id &&
                                $today->format('Y-m-d') >= $data->tgl_mulai &&
                                $today->format('Y-m-d') <= $data->tgl_selesai &&
                                $jm_start->jam_mulai == $data->jam_mulai &&
                                $data->id_sesi == $jm_start->id_sesi)
                            <div class="col-md-6 col-lg-4" id="ujian_{{ $data->id_jadwal_ujian }}">
                                <div class="box box-success box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ $data->nama_mapel }}</h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table class="table-striped" style="width: 100%">
                                            <tr>
                                                <th>Kelas</th>
                                                <th>:</th>
                                                @php
                                                    $decodedIdJurusanValues = json_decode($data->id_jurusan, true);

                                                    // Check if $decodedIdJurusanValues is not null before using it
                                                    if (!is_null($decodedIdJurusanValues)) {
                                                        $matchingKodeJurusanValues = \App\Models\Jurusan::whereIn('id_jurusan', $decodedIdJurusanValues)
                                                            ->pluck('kode_jurusan')
                                                            ->toArray();
                                                    } else {
                                                        // Handle the case when $decodedIdJurusanValues is null
                                                        $matchingKodeJurusanValues = [];
                                                    }
                                                @endphp
                                                <th class="text-right"><span class="label"
                                                        style="background-color: rgb(0, 152, 134)">{{ $data->nama_kelas }} (
                                                        @foreach ($matchingKodeJurusanValues as $index => $kodeJurusan)
                                                            {{ $kodeJurusan }}

                                                            @if ($index < count($matchingKodeJurusanValues) - 1)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                        )
                                                    </span>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>Tanggal Pelaksanaan</th>
                                                <th>:</th>
                                                @php
                                                    $carbonTanggalMulai = Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_mulai);
                                                    $bulanIndonesia = $carbonTanggalMulai->translatedFormat('F');

                                                @endphp
                                                <th class="text-right"><span class="label"
                                                        style="background-color: rgb(0, 58, 152)">{{ $carbonTanggalMulai->format('d') }}
                                                        -
                                                        {{ $bulanIndonesia }} -
                                                        {{ $carbonTanggalMulai->format('Y') }}</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Selesai</th>
                                                <th>:</th>
                                                @php
                                                    $carbonTanggalSelesai = Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_selesai);
                                                    $bulanIndonesia = $carbonTanggalSelesai->translatedFormat('F');
                                                @endphp
                                                <th class="text-right"><span class="label"
                                                        style="background-color: rgb(233, 53, 8)">{{ $carbonTanggalSelesai->format('d') }}
                                                        -
                                                        {{ $bulanIndonesia }} -
                                                        {{ $carbonTanggalSelesai->format('Y') }}</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Jam</th>
                                                <th>:</th>
                                                @php
                                                    $waktuMulai = $data->jam_mulai;
                                                    $mulai = substr($waktuMulai, 0, 5);
                                                    $waktuSelesai = $data->jam_selesai;
                                                    $selesai = substr($waktuSelesai, 0, 5);
                                                @endphp
                                                <th class="text-right"><span
                                                        class="label label-success">{{ $mulai }}</span>
                                                    - <span class="label label-danger">{{ $selesai }}</span></th>
                                            </tr>
                                            <tr>
                                                <th>Durasi</th>
                                                <th>:</th>
                                                <th class="text-right"><span class="label"
                                                        style="background-color: rgb(207, 135, 0)">{{ $data->durasi }}
                                                        Menit</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Jumlah Soal</th>
                                                <th>:</th>
                                                <th class="text-right"><span class="label"
                                                        style="background-color: rgb(150, 32, 130)">{{ $data->jumlah_soal }}</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Sesi</th>
                                                <th>:</th>
                                                <th class="text-right"><span
                                                        class="label label-primary">{{ $data->id_sesi }}</span></th>
                                            </tr>
                                        </table>
                                        @php
                                            $sudah = null; // Inisialisasi $sudah dengan null
                                        @endphp

                                        @if ($nilai != null && $nilai->id_jenis != null)
                                            @php
                                                $sws = Auth::guard('siswa')->user()->id_siswa;
                                                $sudah = \App\Models\SiswaNilai::where('id_jenis', $data->id_jenis)
                                                    ->where('id_siswa', $sws)
                                                    ->where('id_mapel', $data->id_mapel)
                                                    ->whereYear('created_at', '=', date('Y'))
                                                    ->first();
                                            @endphp
                                        @endif
                                        @php
                                            $woi = \Carbon\Carbon::now('Asia/Jakarta')->format('H:i:s');
                                            $mula = $today->setTimeFromTimeString($woi);
                                            $tglSelesai = \Carbon\Carbon::parse($data->tgl_selesai)->timezone('Asia/Jakarta');
                                            $batas = $tglSelesai->setTimeFromTimeString($waktuSelesai);
                                        @endphp
                                        @if ($sudah != null)
                                            <div class="containerz col-md-auto text-center">
                                                <button class="btn btn-success">Sudah Mengerjakan</button>
                                            </div>
                                        @elseif ($kerjakan == null && $data->token == 1 && $woi >= $waktuMulai && $mula <= $batas && $sudah == null)
                                            {{-- <div class="containerz col-md-auto text-center">
                                                <button class="btn btn-primary" onclick="toggleElements()">Masukkan
                                                    Token</button>
                                            </div> --}}
                                            <div class="containerz col-md-auto text-center" id="masukkanTokenSection">
                                                <button class="btn btn-primary"
                                                    onclick="toggleElements('{{ $data->id_jadwal_ujian }}')">Masukkan
                                                    Token</button>
                                            </div>

                                            <form action="{{ route('siswas.store') }}" method="POST">
                                                @csrf
                                                <div class="containerz mt-5 text-center"
                                                    id="tokenForm_{{ $data->id_jadwal_ujian }}" style="display: none">
                                                    <h5><b>Token :</b></h5>
                                                    <input type="text" id="tokenInput" name="tokenInput">
                                                    {{-- <input type="hidden" id="siswa_mulai" name="siswa_mulai"
                                                        value="{{ $mula }}"> --}}
                                                    <input type="hidden" id="idUjian" name="idUjian"
                                                        value="{{ $data->id_jadwal_ujian }}">
                                                    <input type="hidden" id="idbank" name="idbank"
                                                        value="{{ $data->id_bank_soal }}">
                                                    <input type="hidden" id="acakSoal" name="acakSoal"
                                                        value="{{ $data->acak_soal }}">
                                                    <input type="hidden" id="jumlahSoal" name="jumlahSoal"
                                                        value="{{ $data->jumlah_soal }}">
                                                    <input type="hidden" id="jumlahPoint" name="jumlahPoint"
                                                        value="{{ $data->point }}">
                                                    <div class="containerz mt-5 text-center">
                                                        <button class="btn btn-primary" style="margin-top: 10px;"
                                                            type="submit">Mulai
                                                            Ujian</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @elseif ($kerjakan == null && $data->token == 1 && \Carbon\Carbon::now('Asia/Jakarta')->format('H:i:s') < $data->jam_mulai)
                                            <div class="containerz col-md-auto text-center">
                                                <button class="btn btn-warning">Ujian Belum Dimulai</button>
                                            </div>
                                        @elseif ($woi >= $waktuMulai && $mula >= $batas)
                                            <div class="containerz col-md-auto text-center">
                                                <button class="btn btn-danger">Ujian Sudah Berakhir</button>
                                            </div>
                                        @elseif ($kerjakan != null && $data->token == 1)
                                            <div class="containerz col-md-auto text-center">
                                                <form action="{{ route('siswas.mengerjakan') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" id="id_ujian" name="id_ujian"
                                                        value="{{ $data->id_jadwal_ujian }}">
                                                    <button class="btn btn-primary" type="submit">Lanjutkan
                                                        Ujian</button>
                                                </form>
                                            </div>
                                        @endif

                                        {{-- TANPA TOKEN --}}

                                        @if ($kerjakan == null && $data->token == 0)
                                            <div class="containerz col-md-auto text-center">
                                                <button class="btn btn-primary">Mulai Ujian</button>
                                            </div>
                                        @elseif ($kerjakan == null && $data->token == 0 && \Carbon\Carbon::now('Asia/Jakarta')->format('H:i:s') < $data->jam_mulai)
                                            <div class="containerz col-md-auto text-center">
                                                <button class="btn btn-warning">Ujian Belum Dimulai</button>
                                            </div>
                                        @elseif ($kerjakan == null && $data->token == 0 && \Carbon\Carbon::now('Asia/Jakarta')->format('H:i:s') > $data->jam_selesai)
                                            <div class="containerz col-md-auto text-center">
                                                <button class="btn btn-danger">Ujian Sudah Berakhir</button>
                                            </div>
                                        @elseif ($kerjakan != null && $data->token == 0)
                                            <div class="containerz col-md-auto text-center">
                                                <button class="btn btn-Primary">Lanjutkan Ujian</button>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
    </section>
    <!-- /.content -->
@endsection



@push('script')
    <script>
        $(document).ready(function() {
            $('.table').DataTable()
        })

        $(document).ready(function() {
            // ...

            // Fungsi untuk membuka modal dan mengatur judul
            function openModal(title) {
                $('.modal-title').text(title);
                // ...
            }

            // Menangkap event tombol dengan atribut data-target="#modalTambahSiswa"
            $('button[data-target="#modalTambahSiswa"]').on('click', function() {
                var title = "Tambah Siswa";
                openModal(title);
            });
            // Menangkap event tombol dengan atribut data-target="#modalImportSiswa"
            $('button[data-target="#importModal"]').on('click', function() {
                var title = "Import Data Siswa";
                openModal(title);
            });
        });

        // Baru

        function toggleElements(ujianId) {
            var tokenForms = document.querySelectorAll('[id^="tokenForm_"]');
            var masukkanTokenBtn = document.getElementById('masukkanTokenSection');
            var tokenInput = document.getElementById('tokenInput');

            // Hide all tokenForm divs
            tokenForms.forEach(function(form) {
                form.style.display = 'none';
            });

            // Show the selected tokenForm div
            var selectedTokenForm = document.getElementById('tokenForm_' + ujianId);
            selectedTokenForm.style.display = 'block';
            masukkanTokenBtn.style.display = 'none';
            tokenInput.focus();

            // Log the ujianId for demonstration purposes
            console.log('Ujian ID:', ujianId);
        }


        function startExam() {
            var tokenForm = document.getElementById('tokenForm');
            var masukkanTokenBtn = document.getElementById('masukkanTokenSection');
            var tokenInput = document.getElementById('tokenInput');

            // Lakukan sesuatu saat tombol "Mulai Ujian" ditekan

            // Contoh: Sembunyikan formulir dan tampilkan tombol kembali
            tokenForm.style.display = 'none';
            masukkanTokenBtn.style.display = 'block';
        }
    </script>
@endpush

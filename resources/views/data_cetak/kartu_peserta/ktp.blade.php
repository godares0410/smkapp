<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/cetak.css') }}">
    <style>
        @page {
            size: A4;
            margin: 0;
            /* Menghapus margin pada semua sisi */
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .col {
            padding: 1.25mm;
            border: 0.5px solid rgba(128, 128, 128, 0.5); /* Warna abu-abu dengan transparansi 50% */
            box-sizing: border-box;
            border-radius: 8px; /* Anda bisa menyesuaikan nilai ini untuk mengubah tingkat kelengkungan sudut */
            margin-bottom: 8px;
        }
        .colz {
            padding: 1.25mm;
            border: 0.5px solid rgba(128, 128, 128, 0.5); /* Warna abu-abu dengan transparansi 20% */
            box-sizing: border-box;
            border-radius: 8px; /* Anda bisa menyesuaikan nilai ini untuk mengubah tingkat kelengkungan sudut */
            margin-bottom: 8px;
        }




        .card {
            height: 51.50mm;
            width: 83.10mm;
            /* padding : 1mm; */
            /* border: 1px solid black; */
            overflow: hidden;
        }

        .no-border {
            margin-top: 5px;
            border-collapse: collapse;
            font-size: 9px;
            font-weight: bold;
        }
        .no-border td,
        .no-border th {
            border: none;
            padding: 1px;
        }
        .no-borderz {
            margin-top: 5px;
            border-collapse: collapse;
            font-size: 9px;
        }

        .no-borderz td,
        .no-borderz th {
            border: none;
            padding: 1px;
        }
        

        @media print {
            .container>.col .card {
                page-break-inside: avoid;
                /* Menghindari pemisahan kartu di antara halaman */
            }

            @page {
                margin-top: 6mm;
                /* Margin atas untuk setiap halaman cetak */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        @foreach ($siswa as $data)
            <div class="col">
                <div class="card" style="position: relative;">
                    <img src="{{ asset('img/ktp/dpn.svg') }}" style="width: 100%; position: absolute; z-index: -1;" alt="">
                    <div style="height: 30%;">
                        <div style="display: flex; flex-direction: row; align-items: center;">
                            <div style="width: 20%;">
                                <img src="{{ asset('img/file/logo.png') }}" style="width: 65%; margin-left: 17px; background-color: transparent;" alt="">
                            </div>
                            <div style="width:60%; text-align: center; font-size: 11px; font-weight: bold; color: transparent !important; margin-top: 11px;">
                                KARTU TANDA PELAJAR <br>
                                SMK PUSAT KEUNGGULAN <br>
                                SMK SABILILLAH
                            </div>

                            
                        </div>
                            <div style="display: flex; flex-direction: row;">
                                <div style="width: 20%;">
                                    @if ($data->foto != null)
                                        <img src="{{ asset('img/siswa/' . $data->foto) }}" style="width: 90%; padding: 5%;  margin-top: 17px" alt="">
                                        <br>
                                    @else
                                        <img src="{{ asset('img/siswa/icon.jpg') }}" style="width: 90%; padding: 5%; margin-top: 10px" alt="">
                                    @endif
                                </div>
                                <div style="width: 80%;">
                                    <table class="no-border">
                                        <tr>
                                            <td style="vertical-align: top;">Nama</td>
                                            <td style="vertical-align: top;">:</td>
                                            <td style="vertical-align: top;">{{ $data->nama_siswa }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 52px">Kejuruan</td>
                                            <td>:</td>
                                            <td>{{ $data->nama_jurusan }}</td>
                                        </tr>
                                        @php
                                            $carbonTanggalMulai = \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl);
                                            $bulanIndonesia = [
                                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                                                4 => 'April', 5 => 'Mei', 6 => 'Juni',
                                                7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                                                10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                                            ];
                                        @endphp
                                        <tr>
                                            <td>TTL</td>
                                            <td>:</td>
                                            <td>{{ ucwords(strtolower($data->kota)) }},  {{ $carbonTanggalMulai->format('d') }}-{{ $bulanIndonesia[$carbonTanggalMulai->format('n')] }}-{{ $carbonTanggalMulai->format('Y') }}
                                        </tr>
                                       <tr>
                                            <td style="vertical-align: top;">Alamat</td>
                                            <td style="vertical-align: top;">:</td>
                                            <td style="vertical-align: top;">{{ ucwords(strtolower($data->alamat)) }}</td>
                                        </tr>

                                        <tr>
                                            <td style="vertical-align: top;">Gol. Darah</td>
                                            <td style="vertical-align: top;">:</td>
                                            <td style="vertical-align: top;">{{ $data->golongan_darah ? strtoupper($data->golongan_darah) : '-' }}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 60%;">
                                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG("$data->id_siswa", 'C128') }}" alt="QR Code" style="height: 30px; margin-left: 7px; margin-top: 10px;" />
                                </div>
                                <div style="width: 40%; display: flex; align-items: center; flex-direction: column;">
                                    <div style="font-size: 7px; font-weight: bold;">Kepala Sekolah</div>
                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('https://smksabilillah.sch.id/ks', 'QRCODE') }}" alt="QR Code" style="height: 30px; margin-top: 2px; margin-bottom: 1px" />
                                    <div style="font-size: 7px; font-weight: bold;">Fachrur Rozi, S.Pd.I, M.Pd</div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div style="width: 30px; height:100px; display: flex">
                <div style="width: 48%; height: 100%; black; border-right: 1px solid black; margin-right: 2%">
                </div>
                <div style="width: 48%; height: 100%; black; border-left: 1px solid black; margin-left: 2%">
                </div>
            </div>
            <div class="colz">
                <div class="card" style="position: relative;">
                    <img src="{{ asset('img/ktp/blk.svg') }}" style="width: 100%; position: absolute; z-index: -1;" alt="">
                    <div style="height: 30%;">
                        <div style="display: flex; flex-direction: row; align-items: center">
                            <div style="width:60%; text-align: center; font-size: 11px; font-weight: bold; color: transparent; margin-top: 6px">
                                FUNGSI DAN KEGUNAAN <br>
                                KTP SMK SABILILLAH
                            </div>
                            <div style="width: 40%;">
                                <img src="{{ asset('img/file/logo.png') }}" style="height: 40px; margin-left: 80px" alt="">
                            </div>
                        </div>
                        <div style="height: 70%;">
                            <div style="display: flex; flex-direction: row;">
                                <div style="width: 100%; margin-left: 5px; margin-right: 5px">
                                    <table class="no-borderz">
                                        <tr>
                                            <td style="vertical-align: top;">1.</td>
                                            <td style="vertical-align: top;"><b>Absensi Siswa:</b> Digunakan untuk absensi harian siswa secara elektronik.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">2.</td>
                                            <td style="vertical-align: top;"><b>Monitoring Absensi:</b> Memudahkan sekolah dan orang tua memantau kehadiran siswa.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">3.</td>
                                            <td style="vertical-align: top;"><b>Identifikasi Diri:</b> Sebagai identitas resmi siswa yang terdaftar.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">4.</td>
                                            <td style="vertical-align: top;"><b>Partisipasi Kompetisi:</b> Identifikasi resmi saat mengikuti kompetisi akademik, olahraga, atau seni.</td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align: top;">5.</td>
                                            <td style="vertical-align: top;"><b>Keamanan Sekolah:</b> Membantu mengontrol dan memastikan keamanan di lingkungan sekolah.</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 48%;">
                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('https://smksabilillah.sch.id/absen/siswa/' . $data->id_siswa, 'QRCODE') }}" alt="QR Code" style="width: 35px; padding:2px; border: 1px solid; margin-left: 7px" />
                                </div>
                                <div style="width: 52%; height: 100%; display: flex; flex-direction: column;">
                                    <div style="font-size: 7px; margin-top: 29%; color: transparent">Jl. Dadapan. Grogol, Gondangwetan, Kab. Pasuruan</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        @endforeach
    </div>
    <script>
        window.onload = function() {
            window.print(); // Melakukan pencetakan
        };
    </script>
</body>

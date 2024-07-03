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
            padding: 5px;
            box-sizing: border-box;
        }

        .card {
            height: 53.98mm;
            width: 85.60mm;
            border: 1px solid black;
            overflow: hidden;
        }

        .no-border {
            margin-top: 4px;
            border-collapse: collapse;
            font-size: 11px;
            font-weight: bold;
        }

        .no-border td,
        .no-border th {
            border: none;
            padding: 1px;
        }

        @media print {
            .container>.col .card {
                page-break-inside: avoid;
                /* Menghindari pemisahan kartu di antara halaman */
            }

            @page {
                margin-top: 5mm;
                /* Margin atas untuk setiap halaman cetak */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        @foreach ($siswa as $data)
            <div class="col">
                <div class="card">
                    <div style="height: 30%;">
                        <div
                            style="border-bottom: 1px solid black; display: flex; flex-direction: row; align-items: center">
                            <div style="width: 20%;">
                                <img src="{{ asset('img/website/logo/_1716540967.png') }}" style="width: 95%"
                                    alt="">
                            </div>
                            <div style="width:60%; text-align: center; font-size: 13px; font-weight: bold;">
                                KARTU PESERTA PSAT <br>
                                SMK SABILILLAH <br>
                                TAHUN PELAJARAN 2023/2024
                            </div>
                            <div style="width: 20%;">
                                <img src="{{ asset('img/website/logo/_1716541080.png') }}" style="width: 95%"
                                    alt="">
                            </div>
                        </div>
                        <div style="height: 70%;">
                            <div style="display: flex; flex-direction: row;">
                                <div style="width: 20%;">
                                    @if ($data->foto != null)
                                        <img src="{{ asset('img/siswa/' . $data->foto) }}"
                                            style="width: 90%; padding: 5%" alt="">
                                        <br>
                                    @else
                                        <img src="{{ asset('img/siswa/icon.jpg') }}"
                                            style="width: 90%; padding: 5%; margin-top: 10px" alt="">
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
                                            <td style="width: 100px">Kelas</td>
                                            <td>:</td>
                                            <td>{{ $data->nama_kelas }} {{ $data->kode_jurusan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <td>:</td>
                                            {{-- <td>
                                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG("$data->id_siswa", 'QRCODE') }}"
                                                    alt="QR Code" style="width: 50px;" />
                                            </td> --}}
                                            <td>{{ $data->username }}</td>
                                            {{-- <td>{!! DNS1D::getBarcodeHTML("$data->id_siswa", 'PHARMA') !!}</td>
                                            <td>{!! DNS2D::getBarcodeHTML("$data->id_siswa", 'QRCODE') !!}</td> --}}

                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td>:</td>
                                            <td>{{ $data->password }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat / Sesi</td>
                                            <td>:</td>
                                            <td>{{ $data->nama_ruang }} / {{ $data->nama_sesi }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div style="display: flex;">
                                {{-- <div style="width: 60%;">
                                    @php
                                        // Encrypt the $data->id_siswa using Laravel's encryption
                                        $encrypted_id_siswa = encrypt($data->id_siswa);

                                        // Generate the QR code with the encrypted ID
                                        $barcode_data = 'https://smksabilillah.sch.id/absen/siswa/' . urlencode($encrypted_id_siswa);
                                        $barcode_image = DNS2D::getBarcodePNG($barcode_data, 'QRCODE');
                                    @endphp

                                    <img src="data:image/png;base64,{{ $barcode_image }}" alt="QR Code" style="width: 40px; padding:4px; border: 1px solid; margin-left: 7px" />

                                </div> --}}
                                <div style="width: 60%;">
                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('https://smksabilillah.sch.id/absen/siswa/' . "$data->id_siswa", 'QRCODE') }}"
                                        alt="QR Code"
                                        style="width: 40px; padding:4px; border: 1px solid; margin-left: 7px" />
                                </div>
                                <div
                                    style="width: 40%; display: flex; align-items: center; flex-direction: column; justify-content: flex-end;">
                                    <div style="font-size: 10px;">Kepala Sekolah</div>
                                    <img src="{{ asset('img/kartu/ttd.png') }}" style="height: 30px;" alt="">
                                    <div style="font-size: 10px;">Fachrur Rozi, S.Pd, M.Pd.I</div>
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

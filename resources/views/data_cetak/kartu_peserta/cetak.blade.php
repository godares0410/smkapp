<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/cetak.css') }}">
    <style>
        @page {
            size: A4;
            margin: 0; /* Menghapus margin pada semua sisi */
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
        }
        .no-border {
            margin-top: 10px;
            border-collapse: collapse;
            font-size: 12px;
            font-weight: bold;
        }

        .no-border td, .no-border th {
            border: none;
            padding: 1px;
        }

        @media print {
            .container > .col .card {
                page-break-inside: avoid; /* Menghindari pemisahan kartu di antara halaman */
            }
        @page {
                margin-top: 5mm; /* Margin atas untuk setiap halaman cetak */
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
                    <div style="border-bottom: 1px solid black; display: flex; flex-direction: row; align-items: center">
                        <div style="width: 20%;">
                            <img src="{{ asset('img/website/logo/_1716540967.png') }}" style="width: 95%" alt="">
                        </div>
                        <div style="width:60%; text-align: center; font-size: 13px; font-weight: bold;">
                            KARTU PESERTA PAT <br>
                            SMK SABILILLAH <br>
                            TAHUN PELAJARAN 2023/2024
                        </div>
                        <div style="width: 20%;">
                            <img src="{{ asset('img/website/logo/_1716541080.png') }}"  style="width: 95%"  alt="">
                        </div>
                    </div>
                    <div style="height: 70%;">
                        <div style="display: flex; flex-direction: row;">
                            <div style="width: 20%;">
                             <img src="{{ asset('img/siswa/IMG_9298.jpg') }}" style="width: 90%; padding: 5%" alt="">
                            </div>
                            <div style="width: 80%;">
                                <table class="no-border">
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{$data->nama_siswa}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas / Sesi Ujian</td>
                                        <td>:</td>
                                        <td>{{$data->nama_kelas}} {{$data->kode_jurusan}} / {{$data->nama_sesi}}</td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td>:</td>
                                        <td>{{$data->username}}</td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>:</td>
                                        <td>{{$data->password}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Ujian</td>
                                        <td>:</td>
                                        <td>{{$data->nama_ruang}}</td>
                                    </tr>
                                </table>
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
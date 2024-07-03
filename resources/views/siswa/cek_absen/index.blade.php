<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Absen | {{ $siswa->nama_siswa}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .containerz {
            position: relative; /* Menambahkan posisi relatif */
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #ccc;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 20%;
            overflow: hidden;
        }

        .bg {
            position: relative; /* Menjadikan posisi absolut */
            top: 0;
            left: 0;
            width: 100%;
            height: auto;
            z-index: 1; /* Mengatur z-index lebih rendah agar berada di bawah gambar siswa */
        }
        .konten {
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        z-index: 2;
        top: 25%;
        }
        .siswa {
        width: 30%;
        /* top: 1%; */
        border: 6px solid #0659b8; /* Border biru dengan ketebalan 4px */
        border-radius: 8px; /* Lengkungan sudut 8px */
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.3); /* Shadow biru dengan opasitas */
        }
        .nama {
        width: 90%;
        z-index: 2;
        margin-top: 5%;
        font-family: 'Montserrat', sans-serif; /* Menggunakan font Montserrat */
        color: #007bff; /* Warna teks biru (#007bff) */
        font-size: 1.3rem;
        font-weight: bold; /* Teks bold (tebal) */
        text-align: center; /* Teks ditengahkan */
        /* border: 1px solid black; */
        }
        .keterangan {
        display: flex;
        align-items: center; /* Vertikal */
        justify-content: center; /* Horizontal */
        text-align: center;
        width: 60%;
        z-index: 2;
        border: 2px solid #cccccc; /* Border biru dengan ketebalan 4px */
        background-color: #e3e3e3;
        border-radius: 8px; /* Lengkungan sudut 8px */
        box-shadow: 0 0 10px rgba(128, 128, 128, 0.3); /* Warna shadow abu-abu */
        }
        .ta {
            padding: 2px;
            font-weight:bold;
        }
        .ket {
            margin-top : 5%;
            padding: 2px;
            font-weight:bold;
        }
        .pemb {
            margin-top : 1%;
            padding: 2px;
            font-weight:bold;
        }
        .login-page::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('/img/website/bg/_1703127815.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(10px); /* Adjust the blur radius as needed */
            z-index: -1;
        }

        .login-page .content {
            position: relative;
            z-index: 1; /* Ensure the content is above the blurred background */
        }
        @media (max-width: 1024px) {
            .containerz {
                width: 80%; /* Lebar 80% pada layar tablet */
            }
        }
        @media (max-width: 600px) {
            .containerz {
                width: 100%; /* Lebar 100% pada layar kecil */
            }
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="containerz">
        <img class="bg" src="{{ asset('img/file/sws.svg') }}" alt="ID Image">
        <div class="konten">
            @if ($siswa->foto != null)
                <img class="siswa" src="{{ asset('img/siswa/' . $siswa->foto) }}" alt="Foto Siswa">
            @else
                <img class="siswa" src="{{ asset('img/siswa/icon.jpg') }}" alt="Foto Default">
            @endif
            <div class="nama">{{ $siswa->nama_siswa }}
            </div>
            <h6 style="text-align: center">
                Tahun Pelajaran 
                @if($tapel && $tapel->nama_tapel)
                    {{$tapel->nama_tapel}}
                @else
                    Belum Dipilih
                @endif
                <br>Semester 
                @if($semester && $semester->nama_semester)
                    {{$semester->nama_semester}}
                @else
                    Belum Dipilih
                @endif
            </h6>
            
            <div class="keterangan d-flex align-items-center justify-content-center">
                <table style="width: 90%; text-align: left;">
                    <tr>
                        <th>Alpa</th>
                        <th>:</th>
                        <th>
                        @if($harialpa != 0 && $jamalpa != 0)
                        {{$harialpa}} hari, {{$jamalpa}} jam
                        @elseif($harialpa != 0)
                            {{$harialpa}} hari
                        @elseif($jamalpa != 0)
                            {{$jamalpa}} jam
                        @else
                            0
                        @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Ijin</th>
                        <th>:</th>
                        <th>
                        @if($hariijin != 0 && $jamijin != 0)
                        {{$hariijin}} hari, {{$jamijin}} jam
                        @elseif($hariijin != 0)
                            {{$hariijin}} hari
                        @elseif($jamijin != 0)
                            {{$jamijin}} jam
                        @else
                            0
                        @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Sakit</th>
                        <th>:</th>
                        <th>
                        @if($harisakit != 0 && $jamsakit != 0)
                        {{$harisakit}} hari, {{$jamsakit}} jam
                        @elseif($harisakit != 0)
                            {{$harisakit}} hari
                        @elseif($jamsakit != 0)
                            {{$jamsakit}} jam
                        @else
                            0
                        @endif
                        </th>
                    </tr>
                </table>
            </div>  
            <div class="ket">
                Keterangan Hari Ini :
            </div>  
            <div class="d-flex justify-content-around">
                @if($masuk != null)
                    <button type="button" class="btn btn-block btn-success btn-xs mx-2" data-bs-toggle="modal" data-bs-target="#masuk">
                        <div style="font-size: 13px; padding: 0; margin-top: -10px;">Sudah Scan Masuk</div>
                        <div style="font-size: 10px; padding: 0; margin: -5px;">(Cek Foto Scan)</div>
                    </button>
                @else
                    <button type="button" class="btn btn-block btn-danger btn-xs mx-2">
                        <div style="font-size: 13px; padding: 0; margin-top: -10px;">Belum Scan Masuk</div>
                        <div style="font-size: 10px; padding: 0; margin: -5px;">(Siswa Belum Masuk)</div>
                    </button>
                @endif
                @if($pulang != null)
                    <button type="button" class="btn btn-block btn-success btn-xs mx-2" data-bs-toggle="modal" data-bs-target="#pulang">
                        <div style="font-size: 13px; padding: 0; margin-top: -10px;">Sudah Scan Pulang</div>
                        <div style="font-size: 10px; padding: 0; margin: -5px;">(Cek Foto Scan)</div>
                    </button>
                @else
                    <button type="button" class="btn btn-block btn-danger btn-xs mx-2">
                        <div style="font-size: 13px; padding: 0; margin-top: -10px;">Belum Scan Pulang</div>
                        <div style="font-size: 10px; padding: 0; margin: -5px;">(Siswa Belum Pulang)</div>
                    </button>
                @endif
            </div>
            <!-- <div class="d-flex justify-content-around">
                <button type="button" class="btn btn-block btn-danger btn-xs mx-2" data-bs-toggle="modal" data-bs-target="#masuk">
                    <div style="font-size: 13px; padding: 0; margin-top: -10px;">Belum Scan Masuk</div>
                    <div style="font-size: 10px; padding: 0; margin: -5px;">(Siswa Belum Masuk)</div>
                </button>
                <button type="button" class="btn btn-block btn-danger btn-xs mx-2" data-bs-toggle="modal" data-bs-target="#pulang">
                    <div style="font-size: 13px; padding: 0; margin-top: -10px;">Belum Scan Pulang</div>
                    <div style="font-size: 10px; padding: 0; margin: -5px;">(Siswa Belum Pulang)</div>
                </button>
            </div> -->
            @if($siswa->id_kelas == 3)
                <div class="pemb">
                    Informasi Pembayaran :
                </div> 
                <button type="button" class="btn btn-block btn-success btn-xs mx-2" data-bs-toggle="modal" data-bs-target="#bayar">
                        <div style="font-size: 13px; padding: 0; margin-top: -10px;">
                            @if ($total == 0)
                                LUNAS
                            @else
                                {{ $totalFormatted }}
                            @endif</div>
                        <div style="font-size: 10px; padding: 0; margin: -5px;">(Lihat Bukti Pembayaran)</div>
                </button>
            @endif
        </div>
    </div>
     <!-- Modal Masuk-->
     <div class="modal fade" id="masuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Scan Masuk {{ $siswa->nama_siswa }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="siswa" src="{{ asset('img/scan/masuk/' . $masuk->foto) }}" style="width: 100%" alt="Foto Siswa">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="pulang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Scan Pulang {{ $siswa->nama_siswa }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="siswa" src="{{ asset('img/scan/pulang/' . $pulang->foto) }}" style="width: 100%" alt="Foto Siswa">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran {{ $siswa->nama_siswa }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <img class="siswa" src="{{ asset('img/scan/pulang/p1.png.jpg') }}" style="width: 100%" alt="Foto Siswa"> -->
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Guru Penerima</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Rp. 500.000</td>
                            <td>10-Mei-2024</td>
                            <td>Dewi Indrasari, S.Pd</td>
                            <td><img src="{{ asset('img/pembayaran/p1.jfif') }}" style="width: 100%" alt="Foto Siswa"></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Rp. 300.000</td>
                            <td>20-Mei-2024</td>
                            <td>Hadi Supriyono, S.Pd</td>
                            <td><img src="{{ asset('img/pembayaran/p2.jfif') }}" style="width: 100%" alt="Foto Siswa"></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Rp. 200.000</td>
                            <td>30-Mei-2024</td>
                            <td>Dewi Indrasari, S.Pd</td>
                            <td><img src="{{ asset('img/pembayaran/p3.jfif') }}" style="width: 100%" alt="Foto Siswa"></td>
                        </tr>
                    </tbody>
                     </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById('masuk');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script>
        // Get the modal
        var modal = document.getElementById('pulang');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script>
        // Get the modal
        var modal = document.getElementById('bayar');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <!-- Tautan ke Bootstrap JS (diletakkan sebelum tag penutup </body>) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

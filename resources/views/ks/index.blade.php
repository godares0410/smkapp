<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kepala Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roca+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            top: 15%;
        }
        .siswa {
            width: 40%; 
            border-radius: 10px;
            border: 5px solid transparent; /* Initial transparent border */
            background: linear-gradient(white, white) padding-box, 
                        linear-gradient(to right, #B8860B, #FFD700, #B8860B) border-box;
        }
        .nama {
            width: 90%;
            z-index: 2;
            margin-top: 15%;
            font-family: 'Montserrat', sans-serif; /* Menggunakan font Montserrat */
            color: white; /* Warna teks biru (#007bff) */
            font-size: 1.3rem;
            font-weight: bold; /* Teks bold (tebal) */
            text-align: center; /* Teks ditengahkan */
            /* border: 1px solid black; */
        }
        .sekolah {
            width: 100%;
            z-index: 2;
            margin-bottom: 5%;
            font-family: 'Roca One', sans-serif; /* Menggunakan font Roca One */
            color: white; /* Warna teks biru (#007bff) */
            font-size: 1.5rem;
            font-weight: bold; /* Teks bold (tebal) */
            text-align: center; /* Teks ditengahkan */
            /* border: 1px solid black; */
        }
        .jabatan {
            width: 100%;
            z-index: 2;
            margin-bottom: 5%;
            font-family: 'Roca One', sans-serif; /* Menggunakan font Roca One */
            color: orange; /* Warna teks biru (#007bff) */
            font-size: 1.5rem;
            font-weight: bold; /* Teks bold (tebal) */
            text-align: center; /* Teks ditengahkan */
            /* border: 1px solid black; */
        }
        .keterangan {
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
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 20%;
            z-index: 3; /* Mengatur z-index lebih tinggi agar berada di atas semua elemen */
        }

        .btn-whatsapp {
            margin-top: 5%;
            width: 50%;
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

        @media (max-width: 600px) {
            .containerz {
                width: 100%; /* Lebar 100% pada layar kecil */
            }
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="containerz">
        <img class="bg" src="{{ asset('img/file/id.svg') }}" alt="ID Image">
        <img class="logo" src="{{ asset('img/website/logo/_1716541080.png') }}" alt="ID Image">
        <div class="konten">
            <div class="sekolah">SMK SABILILLAH</div>
            <img class="siswa" src="{{ asset('img/file/ks.jpeg') }}" alt="Foto Siswa">
            <div class="nama">Fachrur Rozi, S.Pd.I, M.Pd</div>
            <div class="jabatan">Kepala Sekolah</div>
            <a href="https://wa.me/6285649825908" class="btn btn-block btn-success btn-whatsapp">
                <i class="fas fa-phone-alt"></i> Nomor WhatsApp
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

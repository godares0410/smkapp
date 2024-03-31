
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pendaftaran PPDB</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/plugins/iCheck/square/blue.css') }}">
      {{-- Swall --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    body {
        background: url('/img/website/bg/_1703127815.jpg');
        background-size: cover;
        background-position: center;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <img src="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" style="width: 30%;" alt="">
  <br>
    <a href="../../index2.html"><b>Pendaftaran PPDB</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Pendaftaran PPDB SMK Sabilillah 2024</p>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500 // Menutup pesan dalam 1 detik (1000ms)
                });
            </script>
        @endif
    <form action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
      <div class="form-group has-feedback">
        <label for="nik">NIK</label>
        <input type="number" name="nik" id="nik" class="form-control" placeholder="NIK" required>
      </div>
      <div class="form-group has-feedback">
        <label for="no_kk">NO Kartu Keluarga</label>
        <input type="number" name="no_kk" id="no_kk" class="form-control" placeholder="NO Kartu Keluarga" required>
      </div>
      <div class="form-group has-feedback">
        <label for="nama">Nama Pendaftar</label>
        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Pendaftar" required>
      </div>
      <div class="form-group has-feedback">
        <label for="tempatl">Tempat Lahir</label>
        <input type="text" name="tempatl" id="tempatl" class="form-control" placeholder="Tempat Lahir" required>
      </div>
      <div class="form-group has-feedback">
        <label for="tgl">Tanggal Lahir</label>
        <input type="date" name="tgl" id="tgl" class="form-control" placeholder="Tanggal Lahir" required>
      </div>
      <div class="form-group has-feedback">
        <label for="wali">Nama Wali</label>
        <input type="text" name="wali" id="wali" class="form-control" placeholder="Nama Wali" required>
      </div>
      <div class="form-group has-feedback">
        <label for="alamat">Alamat Lengkap</label>
        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap" required>
      </div>
      <div class="form-group has-feedback">
        <label for="asal">Asal Sekolah</label>
        <input type="text" name="asal" id="asal" class="form-control" placeholder="Asal Sekolah" required>
      </div>
      <div class="form-group has-feedback">
        <label for="jurusan">Jurusan Yang Akan Dipilih</label>
          <select class="form-control" id="jurusan" name="jurusan" required>
            <option value="dkv">Desain Komunikasi Visual</option>
            <option value="kpr">Asisten Keperawatan</option>
            <option value="tsm">Teknik Sepeda Motor</option>
          </select>
      </div>
      <div class="form-group has-feedback">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="form-group has-feedback">
        <label for="no_wa">Nomor WA</label>
        <input type="text" name="no_wa" id="no_wa" class="form-control" placeholder="Nomor WA" required>
      </div>
      <div class="form-group has-feedback">
        <label for="foto">Foto</label>
        <input type="file" name="foto" id="foto" class="form-control" placeholder="Foto" required>
        <p>Ukuran Maksimal Foto 2MB</p>
      </div>
      <div class="form-group has-feedback">
          <label for="pendaftaran">Pendaftaran</label>
          <select class="form-control" id="pendaftaran" name="pendaftaran" required onchange="toggleInput()">
              <option value="1">Mandiri</option>
              <option value="2">Non Mandiri</option>
          </select>
      </div>

      <div class="form-group has-feedback" id="guruContainer">
          <label for="guru">Nama Guru</label>
          <input type="text" name="guru" id="guru" class="form-control" placeholder="Nama Guru" style="display: none;">
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('AdminLTE-2/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('AdminLTE-2/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
    function toggleInput() {
        var pendaftaranSelect = document.getElementById('pendaftaran');
        var guruContainer = document.getElementById('guruContainer');
        var guruInput = document.getElementById('guru');

        if (pendaftaranSelect.value === '2') {
            // Jika pilihan Mandiri dipilih, tampilkan input guru
            guruContainer.style.display = 'block';
            guruInput.style.display = 'block';
        } else {
            // Jika pilihan Non Mandiri dipilih, sembunyikan input guru
            guruContainer.style.display = 'none';
            guruInput.style.display = 'none';
        }
    }

    // Panggil fungsi toggleInput saat halaman dimuat untuk menetapkan tampilan awal
    toggleInput();
</script>
</body>
</html>

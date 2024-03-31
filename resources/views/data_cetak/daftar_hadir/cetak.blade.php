<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/cetak.css') }}">
  </head>
  <body>
    <div class="gambar">
    <img src="{{ asset('img/file/_1708924950.png') }}" alt="" style="height: 150px; width: 80%; display: block; margin: 0 auto; margin-top: 15px" />
    </div>
    <div class="judul">
      <h5 style="text-align: center">
        DAFTAR HADIR PESERTA <br />
        ASSESSMEN SATUAN PENDIDIKAN BERBASIS KOMPUTER <br />
        TAHUN PELAJARAN 2023/2024
      </h5>
    </div>
    <div class="konten">
      <div class="form" style="text-align: left; margin-left: 25px;">
        <table style="width: 100%; text-align: left; font-size: 10px">
          <tr>
            <th>Sekolah</th>
            <th>:</th>
            <th>SMK SABILILLAH</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <th>Ruang</th>
            <th>:</th>
            <th>{{ $ruangs->nama_ruang}}</th>
            <th>Sesi</th>
            <th>:</th>
            <th>{{ $sesis->nama_sesi}}</th>
          </tr>
          <tr>
            <th>Hari/Tgl</th>
            <th>:</th>
           {{-- @php
              $bulanIndonesia = [
                  1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                  4 => 'April', 5 => 'Mei', 6 => 'Juni',
                  7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                  10 => 'Oktober', 11 => 'November', 12 => 'Desember',
              ];

              $carbonTanggalMulai = \Carbon\Carbon::createFromFormat('Y-m-d', $jadwal->tm)->timezone('Asia/Jakarta');
              $formattedDate = $carbonTanggalMulai->format('d') . '-' . $bulanIndonesia[$carbonTanggalMulai->format('n')] . '-' . $carbonTanggalMulai->format('Y');

               // Ambil nama hari dari tanggal yang diberikan
                $namaHari = $carbonTanggalMulai->format('l'); // 'l' akan mengembalikan nama hari dalam bahasa Inggris (Monday, Tuesday, dst.)
                // Jika Anda ingin menggunakan nama hari dalam bahasa Indonesia, Anda dapat menerjemahkannya secara manual
                $namaHariIndonesia = '';
                switch($namaHari) {
                    case 'Monday':
                        $namaHariIndonesia = 'Senin';
                        break;
                    case 'Tuesday':
                        $namaHariIndonesia = 'Selasa';
                        break;
                    case 'Wednesday':
                        $namaHariIndonesia = 'Rabu';
                        break;
                    case 'Thursday':
                        $namaHariIndonesia = 'Kamis';
                        break;
                    case 'Friday':
                        $namaHariIndonesia = 'Jumat';
                        break;
                    case 'Saturday':
                        $namaHariIndonesia = 'Sabtu';
                        break;
                    case 'Sunday':
                        $namaHariIndonesia = 'Minggu';
                        break;
                }
                $jamMulai = substr($jadwal->jm, 0, -3); // Mengambil semua karakter kecuali 3 karakter terakhir
                $jamSelesai = substr($jadwal->js, 0, -3); // Mengambil semua karakter kecuali 3 karakter terakhir
          @endphp
            <th>{{ $namaHariIndonesia}}, {{ $formattedDate}}</th>
            <th>Jam</th>
            <th>:</th>
            <th>{{ $jamMulai}} - {{ $jamSelesai}}</th>
          </tr> --}}
          @php
              $bulanIndonesia = [
                  1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                  4 => 'April', 5 => 'Mei', 6 => 'Juni',
                  7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                  10 => 'Oktober', 11 => 'November', 12 => 'Desember',
              ];

              $carbonTanggalMulai = \Carbon\Carbon::createFromFormat('Y-m-d', $jadwal->tm)->timezone('Asia/Jakarta');
              $formattedDate = $carbonTanggalMulai->format('d') . '-' . $bulanIndonesia[$carbonTanggalMulai->format('n')] . '-' . $carbonTanggalMulai->format('Y');
              // Tambah 7 hari
              $carbonTanggalMulai->addDays(0);

              // Format tanggal setelah ditambah 7 hari
              $formattedDateAfterAddition = $carbonTanggalMulai->format('d') . '-' . $bulanIndonesia[$carbonTanggalMulai->format('n')] . '-' . $carbonTanggalMulai->format('Y');
               // Ambil nama hari dari tanggal yang diberikan
               // Ambil nama hari dari tanggal yang diberikan
              $namaHari = $carbonTanggalMulai->format('l'); // 'l' akan mengembalikan nama hari dalam bahasa Inggris (Monday, Tuesday, dst.)
              // Jika Anda ingin menggunakan nama hari dalam bahasa Indonesia, Anda dapat menerjemahkannya secara manual
              $namaHariIndonesia = '';
              switch($namaHari) {
                  case 'Monday':
                      $namaHariIndonesia = 'Senin';
                      break;
                  case 'Tuesday':
                      $namaHariIndonesia = 'Selasa';
                      break;
                  case 'Wednesday':
                      $namaHariIndonesia = 'Rabu';
                      break;
                  case 'Thursday':
                      $namaHariIndonesia = 'Kamis';
                      break;
                  case 'Friday':
                      $namaHariIndonesia = 'Jumat';
                      break;
                  case 'Saturday':
                      $namaHariIndonesia = 'Sabtu';
                      break;
                  case 'Sunday':
                      $namaHariIndonesia = 'Minggu';
                      break;
              }

                $jamMulai = substr($jadwal->jm, 0, -3); // Mengambil semua karakter kecuali 3 karakter terakhir
                $jamSelesai = substr($jadwal->js, 0, -3); // Mengambil semua karakter kecuali 3 karakter terakhir
          @endphp
            <th>{{ $namaHariIndonesia}}, {{ $formattedDateAfterAddition}}</th>
            <th>Jam</th>
            <th>:</th>
            <th>{{ $jamMulai}} - {{ $jamSelesai}}</th>
          </tr>
          <tr>
            <th>Mata Pelajaran</th>
            <th>:</th>
            <th>{{ $jadwal->nm}}</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </table>
      </div>
      <div class="nama" style="text-align: left; margin-left: 25px; margin-right: 25px;">
  <table style="font-size: 10px; margin-top: 0; margin-bottom: 0;">
    <thead>
      <tr style="border: 1px solid;">
        <th style="width: 15px; padding: 5px;">No</th>
        <th style="width: 115px; text-align: center; padding: 5px;">Nomor Peserta</th>
        <th style="text-align: center; padding: 5px;">Nama</th>
        <th style="width: 150px; text-align: center; padding: 5px;">Tanda Tangan</th>
        <th style="width: 15px; text-align: center; padding: 5px;">Ket</th>
      </tr>
    </thead>
    <tbody>
      {{-- {{ dd($siswa) }} --}}
      @php
        $counter = 1;
        $ttd = 1;
      @endphp
      @foreach ($siswa as $data)
        <tr>
          <td style="padding: 5px; text-align:center">{{ $counter++}}</td>
          <td style="padding: 5px; text-align:center">00{{ $data->id_jurusan}}-00{{ $data->id_siswa}}-{{ $data->id_kelas}}24</td>
          <td style="padding: 5px;">{{ $data->nama_siswa}}</td>
          <td style="{{ $ttd % 2 == 0 ? 'text-align: center; padding: 5px;' : 'padding: 5px;' }}">{{ $ttd++}}.</td>
          <td style="padding: 5px;"></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
    <div class="bawah" style="display: flex; justify-content:space-between; margin-right: 50px">
      <div class="footer" style="margin-left: 25px;">
        <table style="text-align: left; font-size: 10px">
            <tr style="text-align: left;">
            @php
            if ($tdkhadir != null)
            {
              $hadir = $jumlah_siswa - $tdkhadir;
            }
            elseif ($tdkhadir == null)
            {
              $hadir = $jumlah_siswa;
            }
            @endphp
                <th>Jumlah Peserta</th>
                <th>:</th>
                <th>{{ $jumlah_siswa}}</th>
                <th>Orang</th>
            </tr>
            <tr style="text-align: left;">
                <th>Jumlah Peserta Tidak Hadir</th>
                <th>:</th>
                <th>{{ $tdkhadir}}</th>
                <th>Orang</th>
            </tr>
            <tr style="text-align: left;">
                <th>Jumlah Peserta Hadir</th>
                <th>:</th>
                <th>{{ $hadir }}</th>
                <th>Orang</th>
            </tr>
        </table>
      </div>
          <div class="ttd" style="text-align: center;">
              <p style="font-size: 10px">Proktor</p>
              <br>
              <br>
              <br>
              <br>
              <b style="margin-top: 50px; font-size: 12px">{{ $proktor}}</b>
          </div>
          <div class="ttd" style="text-align: center;">
              <p style="font-size: 10px">Pengawas</p>
              <br>
              <br>
              <br>
              <br>
              <b style="margin-top: 50px; font-size: 12px">{{ $pengawas}}</b>
          </div>
    </div>
  </div>
  <script>
     window.onload = function() {
        window.print(); // Melakukan pencetakan
    };
</script>
  </body>
  
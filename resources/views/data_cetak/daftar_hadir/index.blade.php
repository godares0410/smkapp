<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      @page {
        size: A4;
        margin: 0;
      }
      body {
        margin: 0;
        font-family: Arial, sans-serif;
        /* border: 1px solid; */
      }
      .judul {
        display: flex;
        justify-content: center;
      }
      .nama table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #000; /* Border untuk seluruh tabel */
      }

      .nama th,
      td {
        border: 1px solid #000; /* Border untuk seluruh sel */
        padding: 8px;
        text-align: left;
      }
      .nama th {
        background-color: #f2f2f2;
    }
    </style>
  </head>
  <body>
    <img src="kop.png" alt="" style="width: 100%; margin-top: 15px;" />
    <div class="judul">
      <h3 style="text-align: center">
        DAFTAR HADIR PESERTA <br />
        UJIAN SATUAN PENDIDIKAN BERBASIS KOMPUTER <br />
        TAHUN PELAJARAN 2023/2024
      </h3>
    </div>
    <div class="form" style="text-align: left; padding: 25px">
      <table style="width: 100%;">
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
          <th>1</th>
          <th>Sesi</th>
          <th>:</th>
          <th>1</th>
        </tr>
        <tr>
          <th>Hari/Tgl</th>
          <th>:</th>
          <th>Senin, 26-02-2024</th>
          <th>Jam</th>
          <th>:</th>
          <th>07:00 - 08:30</th>
        </tr>
        <tr>
          <th>Mata Pelajaran</th>
          <th>:</th>
          <th>Pendidikan Agama Islam</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </table>
    </div>
    <div class="nama" style="text-align: left; padding: 25px">
      <table>
        <thead>
          <tr style="border: 1px solid;">
            <th style="width: 15px">No</th>
            <th style="width: 115px; text-align: center;">Nomor Peserta</th>
            <th style="text-align: center;">Nama</th>
            <th style="width: 150px;  text-align: center;">Tanda Tangan</th>
            <th style="width: 15px;  text-align: center;">Ket</th>
          </tr>
          <tbody>
              <tr>
                  <td>1</td>
                  <td>10-190-2024</td>
                  <td>Alex</td>
                  <td>1.</td>
                  <td></td>
                </tr>
              <tr>
                  <td>2</td>
                  <td>10-190-2024</td>
                  <td>Muhammad wdijadijwaijd</td>
                  <td style="text-align: center;">2.</td>
                  <td></td>
                </tr>
              <tr>
                  <td>2</td>
                  <td>10-190-2024</td>
                  <td>Muhammad wdijadijwaijd</td>
                  <td style="text-align: center;">2.</td>
                  <td></td>
                </tr>
              <tr>
                  <td>2</td>
                  <td>10-190-2024</td>
                  <td>Muhammad wdijadijwaijd</td>
                  <td style="text-align: center;">2.</td>
                  <td></td>
                </tr>
            </tbody>
        </thead>
      </table>
    </div>
    <div class="footer" style="margin-left: 25px;">
      <table>
          <tr style="text-align: left;">
              <th>Jumlah Peserta</th>
              <th>:</th>
              <th>28</th>
              <th>Orang</th>
          </tr>
          <tr style="text-align: left;">
              <th>Jumlah Peserta Tidak Hadir</th>
              <th>:</th>
              <th>0</th>
              <th>Orang</th>
          </tr>
          <tr style="text-align: left;">
              <th>Jumlah Peserta Hadir</th>
              <th>:</th>
              <th>0</th>
              <th>Orang</th>
          </tr>
      </table>
    </div>
    <div class="bottom" style="display: flex; justify-content:space-between; align-items: center; margin-left: 150px; margin-right: 150px;">
        <div class="ttd" style="text-align: center;">
            <p>Proktor</p>
            <br>
            <br>
            <br>
            <b style="margin-top: 50px;">Taufiqur Rahman</b>
        </div>
        <div class="ttd" style="text-align: center;">
            <p>Pengawas</p>
            <br>
            <br>
            <br>
            <b style="margin-top: 50px;">Taufiqur Rahman</b>
        </div>
    </div>
  </body>
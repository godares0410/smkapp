@extends('layout.master')

@section('title')
    Laporan
@endsection
<style>
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');
</style>
@php
    $title = View::getSections()['title'];
@endphp

@section('struktur', 'active')
@section('laporan-active', 'active')

@section('badge')
    @parent
    <li class="active">{{ ucwords($title) }}</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

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



        <!-- Small boxes (Stat box) -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data {{ ucwords($title) }}</h3>
            </div>
            <div class="box-body pad">
            <div class="col-md-6">
            <div class="box box-info col-md-6">
              <div class="container mt-5">
  <div class="row">
@php
    $today = \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
    $carbonTanggalMulai = \Carbon\Carbon::createFromFormat('Y-m-d', $today);
    $bulanIndonesia = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
        4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];
@endphp
    <div class="col-md-6">
      <div class="mb-3">
        <label for="exampleTextarea" class="form-label">Laporan Kelas</label>
        <textarea class="form-control" id="exampleTextarea" style="width: 100%; height: 30vh; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; font-family: 'Ubuntu', sans-serif;" readonly>
📑 LAPORAN KELAS HARIAN 📑
===========================
🏫 Kelas     :  {{$name->nama_kelas}}-{{$name->kode_jurusan}}
🗓️ Tanggal :  {{ $carbonTanggalMulai->format('d') }}-{{ $bulanIndonesia[$carbonTanggalMulai->format('n')] }}-{{ $carbonTanggalMulai->format('Y') }}

-----------------------------------------------------
        🖊️ CATATAN HARIAN 🖊️
-----------------------------------------------------
@php
$hadir = $total_siswa - $total_absen; 
@endphp
Jumlah Siswa : {{$total_siswa}}
Siswa Hadir     : {{$hadir}}
Tidak Hadir      : {{$total_absen}} @if ($total_absen == 0)*(Nihil)*
@else

@endif
@if ($total_absen > 0)
-----------------------------------------------------
| No | Nama Siswa
-----------------------------------------------------
@endif
@php
    $counter = 1;
@endphp
@foreach ($nama as $nm)
@php
$spl = ($counter < 10) ? '  ' : (($counter < 100) ? ' ' : '');
$spr = ($counter < 10) ? '  ' : (($counter < 100) ? ' ' : '');
$counter++; $jam_ke_values =[];
@endphp|{{$spl}}{{$counter-1}}{{$spr}}| {{$nm->nama_siswa}} *({{ $nm->keterangan}})*
@php
    $jam_ke_values = [];
    foreach ($absens as $abs) {
        if ($abs->id_siswa == $nm->id_siswa) {
            $jam_ke_values[] = $abs->jam_ke;
        }
    }
    $formatted_values = implode(',', $jam_ke_values);
    $formatted_values = preg_replace('/\s+/', ' ', $formatted_values);
@endphp
@unless(count($jam_ke_values) > 7)          Jam Ke: *({{ trim($formatted_values) }})*
@else
        *(Sehari)*
@endunless
@endforeach
-----------------------------------------------------
            📝 REKAP ABSEN 📝
-----------------------------------------------------
| No | Nama Siswa
-----------------------------------------------------
@php
$counter = 1;
@endphp
@foreach ($siswa as $data)
@php
$spasil = ($counter < 10) ? '  ' : (($counter < 100) ? ' ' : '');
$spasir = ($counter < 10) ? '  ' : (($counter < 100) ? ' ' : '');
$counter++;
@endphp
@php
$alpa = \App\Models\SiswaAbsen::where('id_siswa', $data->id_siswa)->where('keterangan', 'A')->count();
$sakit = \App\Models\SiswaAbsen::where('id_siswa', $data->id_siswa)->where('keterangan', 'S')->count();
$ijin = \App\Models\SiswaAbsen::where('id_siswa', $data->id_siswa)->where('keterangan', 'I')->count();
$harialpa = floor($alpa / 8);
$jamalpa = $alpa % 8;
$harisakit = floor($sakit / 8);
$jamsakit = $sakit % 8;
$hariijin = floor($ijin / 8);
$jamijin = $ijin % 8;
$sp = '         ';
@endphp
|{{$spasil}}{{$counter-1}}{{$spasir}}| {{$data->nama_siswa}}
@if ($alpa != 0 || $sakit != 0 || $ijin != 0)
{{$sp}}A [{{$harialpa}}h, {{$jamalpa}}j], S [{{$harisakit}}h, {{$jamsakit}}j], I [{{$hariijin}}h, {{$jamijin}}j]
@endif
-----------------------------------------------------
@endforeach
</textarea>
      </div>
      <button class="btn btn-primary" onclick="copyToClipboard()" style="margin-top: 10px; margin-bottom: 10px">Copy</button>
      </div>
    </div>
  </div>
  </div>
</div>
<div class="col-md-6">
<div class="box box-success">
<div class="container mt-5">
  
  <div class="col-md-6">
      <div class="mb-3">
        <label for="GrupAbsen" class="form-label">Laporan Grup Absen</label>
        <textarea class="form-control" id="GrupAbsen" style="width: 100%; height: 20vh; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; font-family: 'Ubuntu', sans-serif;" readonly>
@php
    $counter = 1;
@endphp
@foreach ($nama as $nm)
@php $jam_ke_values =[];
@endphp {{$counter++}}. {{$nm->nama_siswa}} *({{ $nm->keterangan}})*
@php
    $jam_ke_values = [];
    foreach ($absens as $abs) {
        if ($abs->id_siswa == $nm->id_siswa) {
            $jam_ke_values[] = $abs->jam_ke;
        }
    }
    $formatted_values = implode(',', $jam_ke_values);
@endphp
@unless(count($jam_ke_values) > 7)          Jam Ke: *({{ trim($formatted_values) }})*
@else
        *(Sehari)*
@endunless
@endforeach
@if ($total_absen == 0)*(Nihil)*
@endif
        </textarea>
  </div>
  <button class="btn btn-primary" onclick="copyToClipboardz()" style="margin-top: 10px; margin-bottom: 10px">Copy</button>
  </div>
  </div>
  </div>
  </div>
        </div>
        </div>
    </section>
@endsection


@push('script')
    <script>

    function copyToClipboard() {
    /* Get the text area element */
    var textarea = document.getElementById("exampleTextarea");

    /* Select the text in the text area */
    textarea.select();

    /* Copy the selected text to the clipboard */
    document.execCommand("copy");

    /* Deselect the text area */
    textarea.setSelectionRange(0, 0);

    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Absen Berhasil Disalin',
                    showConfirmButton: false,
                    timer: 2500 // Menutup pesan dalam 1 detik (1000ms)
                });
  }
    </script>
    <script>

    function copyToClipboardz() {
    /* Get the text area element */
    var textarea = document.getElementById("GrupAbsen");

    /* Select the text in the text area */
    textarea.select();

    /* Copy the selected text to the clipboard */
    document.execCommand("copy");

    /* Deselect the text area */
    textarea.setSelectionRange(0, 0);

    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Absen Berhasil Disalin',
                    showConfirmButton: false,
                    timer: 2500 // Menutup pesan dalam 1 detik (1000ms)
                });
  }
    </script>
@endpush

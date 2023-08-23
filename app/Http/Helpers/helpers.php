<?php

function tanggal_indonesia ($tgl, $tampil_hari = true) {
    $nama_hari = array(
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu'
    );
    $nama_bulan = array(1=>
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
//2023-02-03
$tahun = substr($tgl, 0, 4);
$bulan = $nama_bulan[(int) substr($tgl, 5, 2)];
$tanggal = substr($tgl, 8, 2);
$text = '';

if ($tampil_hari){
    $urutan_hari = date('w', mktime(0,0,0, substr($tgl, 5, 2), $tanggal, $tahun));
    $hari = $nama_hari[$urutan_hari];
    $text .= "$hari, $tanggal-$bulan-$tahun";
} else{
    $text .= "$tanggal-$bulan-$tahun";
}
return $text;
}
<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;

class SiswaImport implements ToModel, WithHeadingRow
{
    // public function model(array $row)
    // {
    //     return new Siswa([
    //         'nama_siswa' => $row['nama_siswa'],
    //         'kelas' => $row['kelas'],
    //         'jurusan' => $row['jurusan'],
    //         'rombel' => $row['rombel'],
    //         'foto' => $row['foto'],
    //     ]);
    // }
    public function model(array $row)
    {
        $siswa = $row['nama_siswa'];
        $kelas =  $row['kelas'];
        $jurusan = $row['jurusan'];
        $rombel = $row['rombel'];
        $foto = $row['foto'];

        // Lakukan operasi lain yang diperlukan

        if (empty($rombel)) {
            $rombel = $kelas . ' ' . $jurusan;
        }

        return new Siswa([
            'nama_siswa' => $siswa,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'rombel' => $rombel,
            'foto' => $foto,
            // Field lain yang perlu diisi
        ]);
    }
}

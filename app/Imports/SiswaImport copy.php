<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Siswa([
            'nama_siswa' => $row['nama_siswa'],
            'kelas' => $row['kelas'],
            'jurusan' => $row['jurusan'],
            'foto' => $row['foto'],
        ]);
    }
}

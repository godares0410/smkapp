<?php

namespace App\Imports;

use App\Models\Jurusan;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JurusanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Jurusan([
            'kode_jurusan' => $row['kode_jurusan'],
        ]);
    }
}

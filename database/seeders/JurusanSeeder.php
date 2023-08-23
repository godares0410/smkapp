<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\Jurusan::create([
            'nama_jurusan' => 'Desain Komunikasi Visual',
            'kode_jurusan' => 'DKV',
        ]);
        \App\Models\Jurusan::create([
            'nama_jurusan' => 'Asisten Keperawatan',
            'kode_jurusan' => 'KPR',
        ]);
        \App\Models\Jurusan::create([
            'nama_jurusan' => 'Teknik Sepeda Motor',
            'kode_jurusan' => 'TSM',
        ]);
    }
}

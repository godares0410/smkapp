<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Kelas::create([
            'nama_kelas' => 'X',
        ]);
        \App\Models\Kelas::create([
            'nama_kelas' => 'XI',
        ]);
        \App\Models\Kelas::create([
            'nama_kelas' => 'XII',
        ]);
    }
}

<?php

namespace Database\Seeders;
use App\Models\Mapel;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mapel::factory(25)->create();
        Mapel::factory()->count(30)->create();

        // \App\Models\Mapel::factory()->create([
        //     'nama_mapel' => 'Bahasa Indo',
        //     'kode_mapel' => 'BIN',
        //     'kelas_mapel' => 'X',
        //     'jurusan_mapel' => 'DKV',
        // ]);
    }
}

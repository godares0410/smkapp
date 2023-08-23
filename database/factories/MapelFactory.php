<?php

namespace Database\Factories;

use App\Models\Mapel;
use Faker\Factory as faker;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mapel>
 */
class MapelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Mapel::class;
    public function definition()
    {
        // $kelas = ['X', 'XI', 'XII'];
        $faker = faker::create();

        return [
            'nama_mapel' => $faker->name(),
            'kode_mapel' => $faker->firstName(),
            'kelas_mapel' => Arr::random(['X', 'XI', 'XII']),
            'jurusan_mapel' => Arr::random(['DKV', 'KPR', 'TSM']),
        ];
    }
}

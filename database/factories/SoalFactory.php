<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as faker;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jawaban = Arr::random(['A', 'B', 'C', 'D', 'E']);
        // $namabank = Arr::random(['PAIX', 'BINXI']);
        $id_banksoal = Arr::random([1, 2]);
        $faker = faker::create();
        return [
            // 'nama_bank_soal' => $namabank,
            'id_bank_soal' => $id_banksoal,
            'soal' => $faker->sentence(),
            'pil_a' => $faker->sentence(),
            'pil_b' => $faker->sentence(),
            'pil_c' => $faker->sentence(),
            'pil_d' => $faker->sentence(),
            'pil_e' => $faker->sentence(),
            'jawaban' => $jawaban,
        ];
    }
}

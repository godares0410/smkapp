<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as faker;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BankSoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jawaban = Arr::random(['A', 'B', 'C', 'D', 'E']);
        $id_mapel = Arr::random([1, 2]);
        $faker = faker::create();
        return [
            'id_mapel' => $id_mapel,
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

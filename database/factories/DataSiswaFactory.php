<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataSiswa>
 */
class DataSiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nisn' => $this->faker->unique()->randomNumber(5, true),
            'alamat' => $this->faker->address(),
            'kelas_id' => $this->faker->numberBetween(1,2),
            'no_HP' => $this->faker->randomNumber(5, true)
        ];
}
}

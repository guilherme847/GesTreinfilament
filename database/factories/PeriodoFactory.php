<?php

namespace Database\Factories;

use App\Models\Idperiodo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeriodoFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idperiodo' => Idperiodo::factory(),
            'Nome' => fake()->regexify('[A-Za-z0-9]{100}'),
            'Data_inicio' => fake()->date(),
            'Data_fim' => fake()->date(),
        ];
    }
}

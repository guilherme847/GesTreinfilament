<?php

namespace Database\Factories;

use App\Models\Idsetor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SetorFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idsetor' => Idsetor::factory(),
            'Nome_setor' => fake()->regexify('[A-Za-z0-9]{45}'),
        ];
    }
}

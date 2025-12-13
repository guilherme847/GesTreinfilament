<?php

namespace Database\Factories;

use App\Models\Idetapa;
use App\Models\Treinamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtapaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idetapa' => Idetapa::factory(),
            'Nome' => fake()->regexify('[A-Za-z0-9]{255}'),
            'Descricao' => fake()->text(),
            'Ordem' => fake()->numberBetween(-10000, 10000),
            'Treinamento_idTreinamento' => fake()->word(),
            'treinamento_id' => Treinamento::factory(),
        ];
    }
}

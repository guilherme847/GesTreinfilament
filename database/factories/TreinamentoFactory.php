<?php

namespace Database\Factories;

use App\Models\IdTreinamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreinamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idTreinamento' => IdTreinamento::factory(),
            'Nome' => fake()->regexify('[A-Za-z0-9]{225}'),
            'Descricao' => fake()->text(),
            'Carga_horaria' => fake()->numberBetween(-10000, 10000),
            'Tipo' => fake()->word(),
            'Modalidade' => fake()->word(),
            'Validade_meses' => fake()->numberBetween(-10000, 10000),
            'requer_validacao_pratica' => fake()->numberBetween(-8, 8),
            'Data_da_criacao' => fake()->dateTime(),
            'Status' => fake()->word(),
        ];
    }
}

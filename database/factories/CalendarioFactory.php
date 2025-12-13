<?php

namespace Database\Factories;

use App\Models\TreinamentoPeriodoSetor;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarioFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'Treinamento_idTreinamento' => fake()->word(),
            'periodo_idperiodo' => fake()->word(),
            'setor_idsetor' => fake()->word(),
            'data_prevista' => fake()->dateTime(),
            'descricao' => fake()->regexify('[A-Za-z0-9]{256}'),
            'treinamento_periodo_setor_id' => TreinamentoPeriodoSetor::factory(),
        ];
    }
}

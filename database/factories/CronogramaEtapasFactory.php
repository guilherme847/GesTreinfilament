<?php

namespace Database\Factories;

use App\Models\TurmaEtapa;
use Illuminate\Database\Eloquent\Factories\Factory;

class CronogramaEtapasFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'Turma_aluno' => fake()->word(),
            'Turma_Treinamento_idTreinamento' => fake()->word(),
            'etapa_idetapa' => fake()->word(),
            'data' => fake()->dateTime(),
            'cronograma_etapascol' => fake()->regexify('[A-Za-z0-9]{45}'),
            'Status' => fake()->word(),
            'turma_etapa_id' => TurmaEtapa::factory(),
        ];
    }
}

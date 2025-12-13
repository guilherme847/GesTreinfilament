<?php

namespace Database\Factories;

use App\Models\UsuarioAsAlunoUsuarioAsInstrutorTreinamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class TurmaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'aluno' => fake()->word(),
            'instrutor' => fake()->word(),
            'Treinamento_idTreinamento' => fake()->word(),
            'Data_vinculo' => fake()->dateTime(),
            'Data_prevista_conclusao' => fake()->date(),
            'Data_conclusao' => fake()->date(),
            'Etapa_teorica_status' => fake()->word(),
            'Etapa_teorica_data' => fake()->date(),
            'Etapa_pratica_data' => fake()->dateTime(),
            'Status_geral' => fake()->word(),
            'Foma_realizacao' => fake()->word(),
            'Observacao' => fake()->text(),
            'usuario_as_aluno_usuario_as_instrutor_treinamento_id' => UsuarioAsAlunoUsuarioAsInstrutorTreinamento::factory(),
        ];
    }
}

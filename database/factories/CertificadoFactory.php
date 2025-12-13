<?php

namespace Database\Factories;

use App\Models\IdCertificado;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificadoFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idCertificado' => IdCertificado::factory(),
            'Codigo_unico' => fake()->regexify('[A-Za-z0-9]{45}'),
            'Data_emissao' => fake()->dateTime(),
            'Caminho_pdf' => fake()->regexify('[A-Za-z0-9]{500}'),
            'Usuario_idUsuario' => fake()->word(),
            'Turma_aluno' => fake()->word(),
            'Turma_Treinamento_idTreinamento' => fake()->word(),
            'usuario_id' => Usuario::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\IdEmpresa;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idEmpresa' => IdEmpresa::factory(),
            'Nome' => fake()->regexify('[A-Za-z0-9]{255}'),
            'Cnpj' => fake()->regexify('[A-Za-z0-9]{18}'),
            'Endereco' => fake()->regexify('[A-Za-z0-9]{45}'),
            'Cidade' => fake()->regexify('[A-Za-z0-9]{100}'),
            'Estado' => fake()->randomLetter(),
            'Cep' => fake()->regexify('[A-Za-z0-9]{10}'),
            'Telefone' => fake()->regexify('[A-Za-z0-9]{20}'),
            'Email_contato' => fake()->regexify('[A-Za-z0-9]{225}'),
            'Ativo' => fake()->numberBetween(-8, 8),
            'Numero_colaboradores' => fake()->numberBetween(-10000, 10000),
            'Data_cadastrado' => fake()->dateTime(),
        ];
    }
}

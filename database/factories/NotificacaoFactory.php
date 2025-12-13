<?php

namespace Database\Factories;

use App\Models\IdNotificacao;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'idNotificacao' => IdNotificacao::factory(),
            'Mensagem' => fake()->regexify('[A-Za-z0-9]{500}'),
            'Tipo' => fake()->word(),
            'Lida' => fake()->numberBetween(-8, 8),
            'Data_criacao' => fake()->dateTime(),
            'Usuario_idUsuario' => fake()->word(),
            'usuario_id' => Usuario::factory(),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Calendario;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CalendarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calendario::create([
            'Treinamento_idTreinamento' => '1',
            'periodo_idperiodo' => '1',
            'setor_idsetor' => '2',
            'data_prevista' => Carbon::create(2025, 1, 15, 8, 0, 0),
            'descricao' => 'Treinamento NR-10 para setor de Segurança do Trabalho',
            'treinamento_periodo_setor_id' => 1,
        ]);

        Calendario::create([
            'Treinamento_idTreinamento' => '2',
            'periodo_idperiodo' => '1',
            'setor_idsetor' => '3',
            'data_prevista' => Carbon::create(2025, 1, 20, 8, 0, 0),
            'descricao' => 'Treinamento NR-35 para equipe de Produção',
            'treinamento_periodo_setor_id' => 2,
        ]);

        Calendario::create([
            'Treinamento_idTreinamento' => '4',
            'periodo_idperiodo' => '1',
            'setor_idsetor' => null,
            'data_prevista' => Carbon::create(2025, 2, 5, 14, 0, 0),
            'descricao' => 'Treinamento de Primeiros Socorros - Geral',
            'treinamento_periodo_setor_id' => 3,
        ]);

        Calendario::create([
            'Treinamento_idTreinamento' => '3',
            'periodo_idperiodo' => '2',
            'setor_idsetor' => '1',
            'data_prevista' => Carbon::create(2025, 4, 10, 8, 0, 0),
            'descricao' => 'Treinamento CIPA - Membros eleitos',
            'treinamento_periodo_setor_id' => 4,
        ]);
    }
}

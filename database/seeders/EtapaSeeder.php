<?php

namespace Database\Seeders;

use App\Models\Etapa;
use Illuminate\Database\Seeder;

class EtapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Etapas para NR-10 (Treinamento ID 1)
        Etapa::create([
            'idetapa' => 1,
            'Nome' => 'Teórica - Conceitos Básicos',
            'Descricao' => 'Aula teórica sobre conceitos básicos de eletricidade e segurança.',
            'Ordem' => 1,
            'Treinamento_idTreinamento' => '1',
            'treinamento_id' => 1,
        ]);

        Etapa::create([
            'idetapa' => 2,
            'Nome' => 'Teórica - Normas e Regulamentações',
            'Descricao' => 'Aula teórica sobre normas regulamentadoras e legislação aplicável.',
            'Ordem' => 2,
            'Treinamento_idTreinamento' => '1',
            'treinamento_id' => 1,
        ]);

        Etapa::create([
            'idetapa' => 3,
            'Nome' => 'Prática - Equipamentos de Proteção',
            'Descricao' => 'Prática de utilização de equipamentos de proteção individual e coletiva.',
            'Ordem' => 3,
            'Treinamento_idTreinamento' => '1',
            'treinamento_id' => 1,
        ]);

        Etapa::create([
            'idetapa' => 4,
            'Nome' => 'Avaliação Final',
            'Descricao' => 'Avaliação teórica e prática final do treinamento.',
            'Ordem' => 4,
            'Treinamento_idTreinamento' => '1',
            'treinamento_id' => 1,
        ]);

        // Etapas para NR-35 (Treinamento ID 2)
        Etapa::create([
            'idetapa' => 5,
            'Nome' => 'Teórica - Riscos em Altura',
            'Descricao' => 'Aula teórica sobre riscos e medidas de controle em trabalhos em altura.',
            'Ordem' => 1,
            'Treinamento_idTreinamento' => '2',
            'treinamento_id' => 2,
        ]);

        Etapa::create([
            'idetapa' => 6,
            'Nome' => 'Prática - Equipamentos de Proteção',
            'Descricao' => 'Prática de uso de EPIs e sistemas de ancoragem.',
            'Ordem' => 2,
            'Treinamento_idTreinamento' => '2',
            'treinamento_id' => 2,
        ]);

        // Etapas para Primeiros Socorros (Treinamento ID 4)
        Etapa::create([
            'idetapa' => 7,
            'Nome' => 'Teórica - Primeiros Socorros',
            'Descricao' => 'Aula teórica sobre técnicas básicas de primeiros socorros.',
            'Ordem' => 1,
            'Treinamento_idTreinamento' => '4',
            'treinamento_id' => 4,
        ]);

        Etapa::create([
            'idetapa' => 8,
            'Nome' => 'Prática - Simulação de Atendimento',
            'Descricao' => 'Prática de simulação de situações de emergência e atendimento.',
            'Ordem' => 2,
            'Treinamento_idTreinamento' => '4',
            'treinamento_id' => 4,
        ]);
    }
}

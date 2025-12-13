<?php

namespace Database\Seeders;

use App\Models\Treinamento;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TreinamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Treinamento::create([
            'idTreinamento' => 1,
            'Nome' => 'NR-10 - Segurança em Instalações e Serviços com Eletricidade',
            'Descricao' => 'Treinamento obrigatório sobre segurança em trabalhos com eletricidade, conforme norma regulamentadora NR-10.',
            'Carga_horaria' => 40,
            'Tipo' => 'obrigatorio',
            'Modalidade' => 'presencial',
            'Validade_meses' => 24,
            'requer_validacao_pratica' => 1,
            'Data_da_criacao' => Carbon::now()->subMonths(3),
            'Status' => 'ativo',
        ]);

        Treinamento::create([
            'idTreinamento' => 2,
            'Nome' => 'NR-35 - Trabalho em Altura',
            'Descricao' => 'Treinamento obrigatório sobre segurança em trabalhos realizados em altura, conforme norma regulamentadora NR-35.',
            'Carga_horaria' => 8,
            'Tipo' => 'obrigatorio',
            'Modalidade' => 'presencial',
            'Validade_meses' => 12,
            'requer_validacao_pratica' => 1,
            'Data_da_criacao' => Carbon::now()->subMonths(2),
            'Status' => 'ativo',
        ]);

        Treinamento::create([
            'idTreinamento' => 3,
            'Nome' => 'CIPA - Comissão Interna de Prevenção de Acidentes',
            'Descricao' => 'Treinamento para membros da CIPA sobre prevenção de acidentes e doenças ocupacionais.',
            'Carga_horaria' => 20,
            'Tipo' => 'obrigatorio',
            'Modalidade' => 'presencial',
            'Validade_meses' => 36,
            'requer_validacao_pratica' => 0,
            'Data_da_criacao' => Carbon::now()->subMonths(2),
            'Status' => 'ativo',
        ]);

        Treinamento::create([
            'idTreinamento' => 4,
            'Nome' => 'Primeiros Socorros',
            'Descricao' => 'Treinamento básico de primeiros socorros para colaboradores.',
            'Carga_horaria' => 4,
            'Tipo' => 'obrigatorio',
            'Modalidade' => 'presencial',
            'Validade_meses' => 12,
            'requer_validacao_pratica' => 1,
            'Data_da_criacao' => Carbon::now()->subMonths(1),
            'Status' => 'ativo',
        ]);

        Treinamento::create([
            'idTreinamento' => 5,
            'Nome' => 'Brigada de Incêndio',
            'Descricao' => 'Treinamento para brigadistas sobre prevenção e combate a incêndios.',
            'Carga_horaria' => 16,
            'Tipo' => 'obrigatorio',
            'Modalidade' => 'presencial',
            'Validade_meses' => 12,
            'requer_validacao_pratica' => 1,
            'Data_da_criacao' => Carbon::now()->subMonths(1),
            'Status' => 'ativo',
        ]);

        Treinamento::create([
            'idTreinamento' => 6,
            'Nome' => 'Boas Práticas de Produção',
            'Descricao' => 'Treinamento sobre boas práticas de manufatura e qualidade na produção.',
            'Carga_horaria' => 8,
            'Tipo' => 'opcional',
            'Modalidade' => 'presencial',
            'Validade_meses' => 0,
            'requer_validacao_pratica' => 0,
            'Data_da_criacao' => Carbon::now()->subWeeks(2),
            'Status' => 'ativo',
        ]);

        Treinamento::create([
            'idTreinamento' => 7,
            'Nome' => 'Gestão de Equipes',
            'Descricao' => 'Treinamento de desenvolvimento de liderança e gestão de equipes.',
            'Carga_horaria' => 16,
            'Tipo' => 'opcional',
            'Modalidade' => 'online',
            'Validade_meses' => 0,
            'requer_validacao_pratica' => 0,
            'Data_da_criacao' => Carbon::now()->subWeeks(1),
            'Status' => 'ativo',
        ]);
    }
}


<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrador Sistema',
            'email' => 'admin@empresa.com',
            'password' => Hash::make('admin123'),
            'tipo' => 'admin',
            'setor' => 'Administração',
            'funcao' => 'Administrador',
            'ativo' => true,
            'data_cadastro' => Carbon::now()->subMonths(6),
            'empresa_id' => 1,
            'setor_id' => 4,
        ]);

        // Técnico de Segurança
        User::create([
            'name' => 'João Silva',
            'email' => 'joao.silva@empresa.com',
            'password' => Hash::make('seguranca123'),
            'tipo' => 'tecnico_seguranca',
            'setor' => 'Segurança do Trabalho',
            'funcao' => 'Técnico de Segurança',
            'ativo' => true,
            'data_cadastro' => Carbon::now()->subMonths(5),
            'empresa_id' => 1,
            'setor_id' => 2,
        ]);

        // RH
        User::create([
            'name' => 'Maria Santos',
            'email' => 'maria.santos@empresa.com',
            'password' => Hash::make('rh123'),
            'tipo' => 'rh',
            'setor' => 'Recursos Humanos',
            'funcao' => 'Analista de RH',
            'ativo' => true,
            'data_cadastro' => Carbon::now()->subMonths(4),
            'empresa_id' => 1,
            'setor_id' => 1,
        ]);

        // Instrutor
        User::create([
            'name' => 'Carlos Oliveira',
            'email' => 'carlos.oliveira@empresa.com',
            'password' => Hash::make('instrutor123'),
            'tipo' => 'instrutor',
            'setor' => 'Segurança do Trabalho',
            'funcao' => 'Instrutor de Treinamentos',
            'ativo' => true,
            'data_cadastro' => Carbon::now()->subMonths(3),
            'empresa_id' => 1,
            'setor_id' => 2,
        ]);

        User::create([
            'name' => 'Ana Costa',
            'email' => 'ana.costa@empresa.com',
            'password' => Hash::make('instrutor123'),
            'tipo' => 'instrutor',
            'setor' => 'Recursos Humanos',
            'funcao' => 'Instrutora de RH',
            'ativo' => true,
            'data_cadastro' => Carbon::now()->subMonths(3),
            'empresa_id' => 1,
            'setor_id' => 1,
        ]);

        // Colaboradores
        User::create([
            'name' => 'Pedro Almeida',
            'email' => 'pedro.almeida@empresa.com',
            'password' => Hash::make('colaborador123'),
            'tipo' => 'colaborador',
            'setor' => 'Produção',
            'funcao' => 'Operador de Máquinas',
            'ativo' => true,
            'data_cadastro' => Carbon::now()->subMonths(2),
            'empresa_id' => 1,
            'setor_id' => 3,
        ]);

        User::create([
            'name' => 'Fernanda Lima',
            'email' => 'fernanda.lima@empresa.com',
            'password' => Hash::make('colaborador123'),
            'tipo' => 'colaborador',
            'setor' => 'Produção',
            'funcao' => 'Operadora de Linha',
            'ativo' => true,
            'data_cadastro' => Carbon::now()->subMonths(2),
            'empresa_id' => 1,
            'setor_id' => 3,
        ]);

        User::create([
            'name' => 'Roberto Souza',
            'email' => 'roberto.souza@empresa.com',
            'password' => Hash::make('colaborador123'),
            'tipo' => 'colaborador',
            'setor' => 'Administração',
            'funcao' => 'Assistente Administrativo',
            'ativo' => true,
            'data_cadastro' => Carbon::now()->subMonths(1),
            'empresa_id' => 1,
            'setor_id' => 4,
        ]);

        User::create([
            'name' => 'Juliana Pereira',
            'email' => 'juliana.pereira@empresa.com',
            'password' => Hash::make('colaborador123'),
            'tipo' => 'colaborador',
            'setor' => 'Financeiro',
            'funcao' => 'Analista Financeiro',
            'ativo' => true,
            'data_cadastro' => Carbon::now()->subMonths(1),
            'empresa_id' => 1,
            'setor_id' => 5,
        ]);

        User::create([
            'name' => 'Lucas Mendes',
            'email' => 'lucas.mendes@empresa.com',
            'password' => Hash::make('colaborador123'),
            'tipo' => 'colaborador',
            'setor' => 'Logística',
            'funcao' => 'Auxiliar de Logística',
            'ativo' => true,
            'data_cadastro' => Carbon::now()->subWeeks(2),
            'empresa_id' => 1,
            'setor_id' => 8,
        ]);
    }
}


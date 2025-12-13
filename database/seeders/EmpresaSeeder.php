<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa1 = Empresa::create([
            'idEmpresa' => 1,
            'Nome' => 'Empresa XYZ Ltda',
            'Cnpj' => '12.345.678/0001-90',
            'Endereco' => 'Rua das Empresas, 123',
            'Cidade' => 'São Paulo',
            'Estado' => 'SP',
            'Cep' => '01234-567',
            'Telefone' => '(11) 3456-7890',
            'Email_contato' => 'contato@empresaxyz.com.br',
            'Ativo' => 1,
            'Numero_colaboradores' => 150,
            'Data_cadastrado' => Carbon::now()->subMonths(6),
        ]);

        $empresa2 = Empresa::create([
            'idEmpresa' => 2,
            'Nome' => 'Tech Solutions S.A.',
            'Cnpj' => '98.765.432/0001-10',
            'Endereco' => 'Avenida Tecnologia, 456',
            'Cidade' => 'Rio de Janeiro',
            'Estado' => 'RJ',
            'Cep' => '21000-000',
            'Telefone' => '(21) 2345-6789',
            'Email_contato' => 'contato@techsolutions.com.br',
            'Ativo' => 1,
            'Numero_colaboradores' => 85,
            'Data_cadastrado' => Carbon::now()->subMonths(3),
        ]);
    }
}


<?php

namespace Database\Seeders;

use App\Models\Setor;
use Illuminate\Database\Seeder;

class SetorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setores = [
            ['idsetor' => 1, 'Nome_setor' => 'Recursos Humanos'],
            ['idsetor' => 2, 'Nome_setor' => 'Segurança do Trabalho'],
            ['idsetor' => 3, 'Nome_setor' => 'Produção'],
            ['idsetor' => 4, 'Nome_setor' => 'Administração'],
            ['idsetor' => 5, 'Nome_setor' => 'Financeiro'],
            ['idsetor' => 6, 'Nome_setor' => 'Comercial'],
            ['idsetor' => 7, 'Nome_setor' => 'Tecnologia da Informação'],
            ['idsetor' => 8, 'Nome_setor' => 'Logística'],
        ];

        foreach ($setores as $setor) {
            Setor::create($setor);
        }
    }
}


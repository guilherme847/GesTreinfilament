<?php

namespace Database\Seeders;

use App\Models\Periodo;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Periodo::create([
            'idperiodo' => 1,
            'Nome' => 'Primeiro Trimestre 2025',
            'Data_inicio' => Carbon::create(2025, 1, 1),
            'Data_fim' => Carbon::create(2025, 3, 31),
        ]);

        Periodo::create([
            'idperiodo' => 2,
            'Nome' => 'Segundo Trimestre 2025',
            'Data_inicio' => Carbon::create(2025, 4, 1),
            'Data_fim' => Carbon::create(2025, 6, 30),
        ]);

        Periodo::create([
            'idperiodo' => 3,
            'Nome' => 'Terceiro Trimestre 2025',
            'Data_inicio' => Carbon::create(2025, 7, 1),
            'Data_fim' => Carbon::create(2025, 9, 30),
        ]);

        Periodo::create([
            'idperiodo' => 4,
            'Nome' => 'Quarto Trimestre 2025',
            'Data_inicio' => Carbon::create(2025, 10, 1),
            'Data_fim' => Carbon::create(2025, 12, 31),
        ]);
    }
}


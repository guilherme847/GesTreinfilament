<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EmpresaSeeder::class,
            SetorSeeder::class,
            UserSeeder::class,
            TreinamentoSeeder::class,
            EtapaSeeder::class,
            PeriodoSeeder::class,
            CalendarioSeeder::class,
        ]);
    }
}

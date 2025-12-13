<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('treinamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idTreinamento');
            $table->string('Nome', 225);
            $table->text('Descricao', 3000)->nullable();
            $table->integer('Carga_horaria');
            $table->string('Tipo');
            $table->string('Modalidade');
            $table->integer('Validade_meses');
            $table->tinyInteger('requer_validacao_pratica');
            $table->timestamp('Data_da_criacao')->nullable();
            $table->string('Status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treinamentos');
    }
};

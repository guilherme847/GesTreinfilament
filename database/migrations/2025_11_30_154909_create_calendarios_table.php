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
        Schema::create('calendarios', function (Blueprint $table) {
            $table->id();
            $table->string('Treinamento_idTreinamento');
            $table->string('periodo_idperiodo');
            $table->string('setor_idsetor')->nullable();
            $table->timestamp('data_prevista')->nullable();
            $table->string('descricao', 256)->nullable();
            $table->foreignId('treinamento_periodo_setor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendarios');
    }
};

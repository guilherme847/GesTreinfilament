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
        Schema::create('etapas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idetapa');
            $table->string('Nome', 255)->nullable();
            $table->text('Descricao')->nullable();
            $table->integer('Ordem')->nullable();
            $table->string('Treinamento_idTreinamento');
            $table->foreignId('treinamento_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapas');
    }
};

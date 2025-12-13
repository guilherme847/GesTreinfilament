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
        Schema::create('cronograma_etapas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('turma_id')->constrained('turmas')->onDelete('cascade');
            $table->foreignId('etapa_id')->constrained('etapas')->onDelete('cascade');
            $table->timestamp('data')->nullable();
            $table->string('observacao', 255)->nullable();
            $table->enum('Status', ['agendado', 'realizado', 'cancelado'])->default('agendado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cronograma_etapas');
    }
};

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
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('instrutor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('treinamento_id')->constrained('treinamentos')->onDelete('cascade');
            $table->timestamp('Data_vinculo')->nullable();
            $table->date('Data_prevista_conclusao')->nullable();
            $table->date('Data_conclusao')->nullable();
            $table->enum('Etapa_teorica_status', ['pendente', 'em_andamento', 'concluida', 'cancelada'])->nullable();
            $table->date('Etapa_teorica_data')->nullable();
            $table->timestamp('Etapa_pratica_data')->nullable();
            $table->enum('Status_geral', ['pendente', 'em_andamento', 'concluida', 'cancelada'])->default('pendente');
            $table->enum('Forma_realizacao', ['presencial', 'online', 'hibrido'])->nullable();
            $table->text('Observacao', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};

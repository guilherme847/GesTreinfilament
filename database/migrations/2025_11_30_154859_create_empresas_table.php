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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idEmpresa');
            $table->string('Nome', 255);
            $table->string('Cnpj', 18)->unique();
            $table->string('Endereco', 45)->nullable();
            $table->string('Cidade', 100)->nullable();
            $table->char('Estado', 2)->nullable();
            $table->string('Cep', 10)->nullable();
            $table->string('Telefone', 20)->nullable();
            $table->string('Email_contato', 225)->nullable();
            $table->tinyInteger('Ativo');
            $table->integer('Numero_colaboradores');
            $table->timestamp('Data_cadastrado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContatosTable extends Migration
{
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->id(); // ID do contato
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade'); // Chave estrangeira para clientes
            $table->string('nome_contato');
            $table->string('email_contato');
            $table->char('fone_contato', 11); // Formato para telefone (DDD + número)
            $table->char('cpf', 11); // CPF
            $table->timestamps(); // Criação e atualização
        });
    }

    public function down()
    {
        Schema::dropIfExists('contatos');
    }
}

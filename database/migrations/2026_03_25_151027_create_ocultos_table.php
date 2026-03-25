<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //Criei uma especia de tabela pivot para armazenar os itens ocultos por cada usuário
    public function up(): void
    {
        Schema::create('ocultos', function (Blueprint $table) {
            $table->id();
            //Coluna de user, para saber quem ocultou o item
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //Colunas dos dados que serão ocultos
            $table->foreignId('flor_id')->nullable()->constrained('flores')->onDelete('cascade');
            $table->foreignId('clientes_id')->nullable()->constrained('clientes')->onDelete('cascade');
            $table->foreignId('pedidos_id')->nullable()->constrained('pedidos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocultos');
    }
};

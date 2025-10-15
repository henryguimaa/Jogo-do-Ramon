<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JogadorQuest extends Migration
{
    public function up(): void
    {
        Schema::create('jogador_quest', function (Blueprint $table) {
            $table->foreignId('id_jogador')->constrained('jogador', 'id_jogador');
            $table->foreignId('id_quest')->constrained('quest', 'id_quest');
            $table->enum('status', ['não iniciada', 'em andamento', 'concluída'])->default('não iniciada');
            $table->primary(['id_jogador', 'id_quest']);
            $table->timestamps();
        });
    }
    
}

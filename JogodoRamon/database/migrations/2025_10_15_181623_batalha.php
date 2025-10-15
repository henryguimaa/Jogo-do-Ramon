<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Batalha extends Migration
{
    public function up(): void
    {
        Schema::create('batalha', function (Blueprint $table) {
            $table->id('id_batalha');
            $table->foreignId('id_jogador')->constrained('jogador', 'id_jogador');
            $table->foreignId('id_inimigo')->constrained('inimigo', 'id_inimigo');
            $table->enum('resultado', ['vitória', 'derrota', 'fugiu']);
            $table->timestamp('data')->useCurrent();
            $table->timestamps();
        });
    }
    
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jogador extends Migration
{
    public function up(): void
{
    Schema::create('jogador', function (Blueprint $table) {
        $table->id('id_jogador');
        $table->string('nome');
        $table->enum('genero', ['masculino', 'feminino', 'outro']);
        $table->integer('nivel')->default(1);
        $table->integer('experiencia')->default(0);
        $table->integer('vida_atual')->default(100);
        $table->integer('vida_maxima')->default(100);
        $table->integer('ataque')->default(10);
        $table->integer('defesa')->default(5);
        $table->integer('velocidade')->default(5);
        $table->foreignId('local_atual')->nullable()->constrained('mapa', 'id_mapa')->onDelete('set null');
        $table->timestamps();
    });
}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inimigo extends Migration
{
    public function up(): void
{
    Schema::create('inimigo', function (Blueprint $table) {
        $table->id('id_inimigo');
        $table->string('nome');
        $table->integer('vida')->default(50);
        $table->integer('ataque')->default(10);
        $table->integer('defesa')->default(5);
        $table->integer('velocidade')->default(5);
        $table->integer('experiencia_drop')->default(20);
        $table->foreignId('id_mapa')->nullable()->constrained('mapa', 'id_mapa');
        $table->timestamps();
    });
}

}

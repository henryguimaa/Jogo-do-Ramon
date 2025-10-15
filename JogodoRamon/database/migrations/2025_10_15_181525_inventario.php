<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inventario extends Migration
{
    public function up(): void
{
    Schema::create('inventario', function (Blueprint $table) {
        $table->foreignId('id_jogador')->constrained('jogador', 'id_jogador');
        $table->foreignId('id_item')->constrained('item', 'id_item');
        $table->integer('quantidade')->default(1);
        $table->primary(['id_jogador', 'id_item']);
        $table->timestamps();
    });
}

}

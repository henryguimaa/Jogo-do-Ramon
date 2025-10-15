<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Npc extends Migration
{
    public function up(): void
    {
        Schema::create('npc', function (Blueprint $table) {
            $table->id('id_npc');
            $table->string('nome');
            $table->text('fala_inicial')->nullable();
            $table->enum('tipo', ['comerciante', 'quest', 'historia', 'outro'])->default('outro');
            $table->foreignId('id_mapa')->nullable()->constrained('mapa', 'id_mapa')->onDelete('cascade');
            $table->timestamps();
        });
    }
        
}

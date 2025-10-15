<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mapa extends Migration
{
    public function up(): void
    {
        Schema::create('mapa', function (Blueprint $table) {
            $table->id('id_mapa');
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->enum('tipo', ['vila', 'floresta', 'masmorra', 'cidade', 'campo'])->default('campo');
            $table->timestamps();
        });
    }
    
}

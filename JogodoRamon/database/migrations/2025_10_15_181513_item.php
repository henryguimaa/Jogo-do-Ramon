<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Item extends Migration
{
    public function up(): void
{
    Schema::create('item', function (Blueprint $table) {
        $table->id('id_item');
        $table->string('nome');
        $table->text('descricao')->nullable();
        $table->enum('tipo', ['arma', 'armadura', 'poção', 'missao', 'outro'])->default('outro');
        $table->integer('valor')->default(0);
        $table->string('efeito')->nullable();
        $table->timestamps();
    });
}

}

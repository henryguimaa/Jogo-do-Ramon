<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Quest extends Migration
{
    public function up(): void
{
    Schema::create('quest', function (Blueprint $table) {
        $table->id('id_quest');
        $table->string('nome');
        $table->text('descricao')->nullable();
        $table->integer('recompensa_xp')->default(0);
        $table->foreignId('recompensa_item')->nullable()->constrained('item', 'id_item');
        $table->timestamps();
    });
}

}

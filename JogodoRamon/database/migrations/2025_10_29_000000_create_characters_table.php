<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
	public function up()
	{
		Schema::create('characters', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('race')->nullable();
			$table->string('char_class')->nullable();
			$table->string('subclass')->nullable();
			$table->string('passive')->nullable();
			$table->integer('hp')->default(100);
			$table->integer('atk')->default(10);
			$table->integer('def')->default(5);
			$table->integer('spd')->default(5);
			$table->string('element')->default('neutral');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('characters');
	}
}

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('characters', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('race')->nullable();
			$table->string('char_class')->nullable();
			$table->string('subclass')->nullable();
			$table->unsignedBigInteger('passive_id')->nullable();
			$table->integer('hp')->default(100);
			$table->integer('atk')->default(10);
			$table->integer('def')->default(5);
			$table->integer('spd')->default(5);
			$table->string('element')->default('neutral');
			$table->timestamps();
			$table->foreign('passive_id')->references('id')->on('passives')->onDelete('set null');
		});
	}

	public function down()
	{
		Schema::dropIfExists('characters');
	}
};

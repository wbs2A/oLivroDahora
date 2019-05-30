<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imagens', function(Blueprint $table)
		{
			$table->integer('idimagens', true);
			$table->string('filename', 100)->nullable();
			$table->string('mime', 45)->nullable();
			$table->string('path', 50)->nullable();
			$table->integer('size')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imagens');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->integer('iduser',1)->unsigned();
			$table->string('nome', 50)->nullable();
			$table->string('email', 45)->nullable();
			$table->string('telefone', 45)->nullable();
			$table->string('senha', 100)->nullable();
			$table->boolean('tipo')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}

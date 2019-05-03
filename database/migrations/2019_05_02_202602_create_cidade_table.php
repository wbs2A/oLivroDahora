<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCidadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cidade', function(Blueprint $table)
		{
			$table->integer('idCidade', true);
			$table->string('nome', 45)->nullable();
			$table->decimal('longitude', 10, 0)->nullable();
			$table->decimal('latitude', 10, 0)->nullable();
			$table->integer('Estado_idEstado')->index('fk_Cidade_Estado_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cidade');
	}

}

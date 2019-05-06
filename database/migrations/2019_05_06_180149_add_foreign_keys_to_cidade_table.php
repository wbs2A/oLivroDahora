<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCidadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cidade', function(Blueprint $table)
		{
			$table->foreign('Estado_idEstado', 'fk_Cidade_Estado')->references('idEstado')->on('estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cidade', function(Blueprint $table)
		{
			$table->dropForeign('fk_Cidade_Estado');
		});
	}

}

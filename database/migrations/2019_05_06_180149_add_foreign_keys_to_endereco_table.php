<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEnderecoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('endereco', function(Blueprint $table)
		{
			$table->foreign('Cidade_idCidade', 'fk_Endereco_Cidade1')->references('idCidade')->on('cidade')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('endereco', function(Blueprint $table)
		{
			$table->dropForeign('fk_Endereco_Cidade1');
		});
	}

}

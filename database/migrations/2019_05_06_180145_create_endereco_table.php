<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('endereco', function(Blueprint $table)
		{
			$table->integer('idEndereco', true);
			$table->string('rua', 45)->nullable();
			$table->string('bairro', 45)->nullable();
			$table->string('cep', 45)->nullable();
			$table->integer('numero')->nullable();
			$table->integer('Cidade_idCidade')->index('fk_Endereco_Cidade1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('endereco');
	}

}

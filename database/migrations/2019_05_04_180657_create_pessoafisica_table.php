<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePessoafisicaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pessoafisica', function(Blueprint $table)
		{
			$table->string('idpessoaFisica', 13)->primary();
			$table->integer('Endereco_idEndereco')->index('fk_pessoaFisica_Endereco1_idx');
			$table->integer('user_iduser')->unsigned()->index('fk_pessoaFisica_user1_idx');
			$table->string('sexo', 45)->nullable();
			$table->string('rg', 45)->nullable();
			$table->date('dataNascimento')->nullable();
			$table->integer('imagens_idimagens')->nullable()->index('fk_pessoaFisica_imagens1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pessoafisica');
	}

}

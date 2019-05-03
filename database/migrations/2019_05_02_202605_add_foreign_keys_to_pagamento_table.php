<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPagamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pagamento', function(Blueprint $table)
		{
			$table->foreign('pessoaFisica_idpessoaFisica', 'fk_pagamento_pessoaFisica1')->references('idpessoaFisica')->on('pessoafisica')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pagamento', function(Blueprint $table)
		{
			$table->dropForeign('fk_pagamento_pessoaFisica1');
		});
	}

}

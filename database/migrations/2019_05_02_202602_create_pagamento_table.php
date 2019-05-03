<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagamento', function(Blueprint $table)
		{
			$table->integer('idpagamento');
			$table->string('nCartao', 45)->nullable();
			$table->string('vcc', 45)->nullable();
			$table->string('formaPagamento', 45)->nullable();
			$table->date('dataValidade')->nullable();
			$table->string('pessoaFisica_idpessoaFisica', 13)->index('fk_pagamento_pessoaFisica1_idx');
			$table->primary(['idpagamento','pessoaFisica_idpessoaFisica']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pagamento');
	}

}

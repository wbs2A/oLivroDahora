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
			$table->integer('idpagamento', true);
			$table->string('nCartao', 45)->nullable();
			$table->string('vcc', 3)->nullable();
			$table->string('formaPagamento', 45)->nullable();
			$table->date('dataValidade')->nullable();
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

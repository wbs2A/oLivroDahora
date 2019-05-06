<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePessoafisicaHasPagamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pessoafisica_has_pagamento', function(Blueprint $table)
		{
			$table->string('pessoafisica_idpessoaFisica', 13)->index('fk_pessoafisica_has_pagamento_pessoafisica1_idx');
			$table->integer('pagamento_idpagamento')->index('fk_pessoafisica_has_pagamento_pagamento1_idx');
			$table->primary(array('pessoafisica_idpessoaFisica','pagamento_idpagamento'),'pessoa_has_pagamento_pk');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pessoafisica_has_pagamento');
	}

}

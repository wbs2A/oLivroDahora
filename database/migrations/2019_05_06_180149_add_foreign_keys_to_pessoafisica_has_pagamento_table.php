<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPessoafisicaHasPagamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pessoafisica_has_pagamento', function(Blueprint $table)
		{
			$table->foreign('pagamento_idpagamento', 'fk_pessoafisica_has_pagamento_pagamento1')->references('idpagamento')->on('pagamento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('pessoafisica_idpessoaFisica', 'fk_pessoafisica_has_pagamento_pessoafisica1')->references('idpessoaFisica')->on('pessoafisica')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pessoafisica_has_pagamento', function(Blueprint $table)
		{
			$table->dropForeign('fk_pessoafisica_has_pagamento_pagamento1');
			$table->dropForeign('fk_pessoafisica_has_pagamento_pessoafisica1');
		});
	}

}

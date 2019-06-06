<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCompraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('compra', function(Blueprint $table)
		{
			$table->foreign('livro_idlivro', 'fk_compra_livro1')->references('idlivro')->on('livro')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('pagamento_idpagamento', 'fk_compra_pagamento1')->references('idpagamento')->on('pagamento')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('compra', function(Blueprint $table)
		{
			$table->dropForeign('fk_compra_livro1');
			$table->dropForeign('fk_compra_pagamento1');
		});
	}

}

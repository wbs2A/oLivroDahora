<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHasCompraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_has_compra', function(Blueprint $table)
		{
			$table->integer('user_iduser')->unsigned()->index('fk_user_has_compra_user1_idx');
			$table->integer('compra_idcompra');
			$table->integer('compra_livro_idlivro');
			$table->primary(['user_iduser','compra_idcompra','compra_livro_idlivro'],'user_compra_livro_pk');
			$table->index(['compra_idcompra','compra_livro_idlivro'], 'fk_user_has_compra_compra1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_has_compra');
	}

}

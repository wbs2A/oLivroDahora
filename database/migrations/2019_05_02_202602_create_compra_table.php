<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('compra', function(Blueprint $table)
		{
			$table->integer('idcompra', true);
			$table->string('valor', 45)->nullable();
			$table->dateTime('data')->nullable();
			$table->integer('user_iduser')->unsigned()->index('fk_compra_user1_idx');
			$table->integer('livro_idlivro')->index('fk_compra_livro1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('compra');
	}

}

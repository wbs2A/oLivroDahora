<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHasCompraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_has_compra', function(Blueprint $table)
		{
			$table->foreign('compra_idcompra', 'fk_user_has_compra_compra1')->references('idcompra')->on('compra')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_iduser', 'fk_user_has_compra_user1')->references('iduser')->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_has_compra', function(Blueprint $table)
		{
			$table->dropForeign('fk_user_has_compra_compra1');
			$table->dropForeign('fk_user_has_compra_user1');
		});
	}

}

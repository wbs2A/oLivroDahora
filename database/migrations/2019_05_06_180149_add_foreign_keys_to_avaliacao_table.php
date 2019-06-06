<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAvaliacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('avaliacao', function(Blueprint $table)
		{
			$table->foreign('user_iduser', 'fk_avaliacao_user1')->references('iduser')->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('avaliacao', function(Blueprint $table)
		{
			$table->dropForeign('fk_avaliacao_user1');
		});
	}

}

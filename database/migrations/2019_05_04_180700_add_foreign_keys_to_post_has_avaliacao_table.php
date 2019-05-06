<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostHasAvaliacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post_has_avaliacao', function(Blueprint $table)
		{
			$table->foreign('avaliacao_idavaliacao', 'fk_post_has_avaliacao_avaliacao1')->references('idavaliacao')->on('avaliacao')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('post_idpost', 'fk_post_has_avaliacao_post1')->references('idpost')->on('post')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post_has_avaliacao', function(Blueprint $table)
		{
			$table->dropForeign('fk_post_has_avaliacao_avaliacao1');
			$table->dropForeign('fk_post_has_avaliacao_post1');
		});
	}

}

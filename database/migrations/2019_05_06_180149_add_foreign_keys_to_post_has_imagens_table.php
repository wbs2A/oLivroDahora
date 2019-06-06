<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostHasImagensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post_has_imagens', function(Blueprint $table)
		{
			$table->foreign('imagens_idimagens', 'fk_post_has_imagens_imagens1')->references('idimagens')->on('imagens')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('post_idpost', 'fk_post_has_imagens_post1')->references('idpost')->on('post')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post_has_imagens', function(Blueprint $table)
		{
			$table->dropForeign('fk_post_has_imagens_imagens1');
			$table->dropForeign('fk_post_has_imagens_post1');
		});
	}

}

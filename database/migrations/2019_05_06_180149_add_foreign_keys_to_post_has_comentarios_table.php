<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostHasComentariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post_has_comentarios', function(Blueprint $table)
		{
			$table->foreign('comentarios_idcomentarios', 'fk_post_has_comentarios_comentarios1')->references('idcomentarios')->on('comentarios')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('post_idpost', 'fk_post_has_comentarios_post1')->references('idpost')->on('post')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post_has_comentarios', function(Blueprint $table)
		{
			$table->dropForeign('fk_post_has_comentarios_comentarios1');
			$table->dropForeign('fk_post_has_comentarios_post1');
		});
	}

}

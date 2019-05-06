<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostHasComentariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_has_comentarios', function(Blueprint $table)
		{
			$table->integer('post_idpost')->index('fk_post_has_comentarios_post1_idx');
			$table->integer('comentarios_idcomentarios');
			$table->integer('comentarios_user_iduser')->unsigned();
			$table->primary(['post_idpost','comentarios_idcomentarios','comentarios_user_iduser'], 'post_comentariopk_key');
			$table->index(['comentarios_idcomentarios','comentarios_user_iduser'], 'fk_post_has_comentarios_comentarios1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_has_comentarios');
	}

}

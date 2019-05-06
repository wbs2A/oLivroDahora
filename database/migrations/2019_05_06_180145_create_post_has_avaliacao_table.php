<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostHasAvaliacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_has_avaliacao', function(Blueprint $table)
		{
			$table->integer('post_idpost')->index('fk_post_has_avaliacao_post1_idx');
			$table->integer('avaliacao_idavaliacao');
			$table->integer('iduser')->unsigned();
			$table->primary(['post_idpost','avaliacao_idavaliacao','iduser'], 'post_avaliacao_user_pk');
			$table->index(['avaliacao_idavaliacao','iduser'], 'fk_post_has_avaliacao1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_has_avaliacao');
	}

}

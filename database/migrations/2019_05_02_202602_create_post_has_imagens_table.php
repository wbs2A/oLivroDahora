<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostHasImagensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_has_imagens', function(Blueprint $table)
		{
			$table->integer('post_idpost');
			$table->integer('post_categoria_idcategoria');
			$table->integer('imagens_idimagens')->index('fk_post_has_imagens_imagens1_idx');
			$table->primary(['post_idpost','imagens_idimagens']);
			$table->index(['post_idpost'], 'fk_post_has_imagens_post1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_has_imagens');
	}

}

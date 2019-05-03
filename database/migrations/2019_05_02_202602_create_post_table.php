<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post', function(Blueprint $table)
		{
			$table->integer('idpost', 1);
			$table->string('titulo', 45)->nullable();
			$table->text('conteudo', 65535)->nullable();
			$table->string('descricao', 45)->nullable();
			$table->integer('categoria_idcategoria')->index('fk_post_categoria1_idx');
			$table->dateTime('datapostagem')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post');
	}

}

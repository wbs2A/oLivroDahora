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
			$table->integer('idpost',1);
			$table->string('titulo', 45)->nullable();
			$table->text('conteudo', 65535)->nullable();
			$table->string('descricao', 45)->nullable();
			$table->dateTime('datapostagem')->nullable();
			$table->integer('categoria_idcategoria1')->index('fk_post_categoria1_idx1');
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

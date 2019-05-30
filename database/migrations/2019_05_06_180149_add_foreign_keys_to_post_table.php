<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post', function(Blueprint $table)
		{
			$table->foreign('categoria_idcategoria', 'fk_post_categoria1')->references('idcategoria')->on('categoria')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post', function(Blueprint $table)
		{
			$table->dropForeign('fk_post_categoria');
		});
	}

}

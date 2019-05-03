<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHasLivroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_has_livro', function(Blueprint $table)
		{
			$table->integer('user_iduser')->unsigned()->index('fk_user_has_livro_user1_idx');
			$table->integer('livro_idlivro')->index('fk_user_has_livro_livro1_idx');
			$table->primary(['user_iduser','livro_idlivro']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_has_livro');
	}

}

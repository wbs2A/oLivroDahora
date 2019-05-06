<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHasLivroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_has_livro', function(Blueprint $table)
		{
			$table->foreign('livro_idlivro', 'fk_user_has_livro_livro1')->references('idlivro')->on('livro')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_iduser', 'fk_user_has_livro_user1')->references('iduser')->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_has_livro', function(Blueprint $table)
		{
			$table->dropForeign('fk_user_has_livro_livro1');
			$table->dropForeign('fk_user_has_livro_user1');
		});
	}

}

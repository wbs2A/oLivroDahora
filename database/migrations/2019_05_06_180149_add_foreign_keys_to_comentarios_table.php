<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComentariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comentarios', function(Blueprint $table)
		{
			$table->foreign('user_iduser', 'fk_comentarios_user1')->references('iduser')->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('imagens_idimagens', 'fk_comentarios_imagens1')->references('idimagens')->on('imagens')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comentarios', function(Blueprint $table)
		{
			$table->dropForeign('fk_comentarios_user1');
		});
	}

}

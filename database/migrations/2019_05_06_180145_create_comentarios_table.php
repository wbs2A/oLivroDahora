<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComentariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comentarios', function(Blueprint $table)
		{
			$table->integer('idcomentarios', true);
			$table->text('texto', 65535)->nullable();
			$table->integer('user_iduser')->unsigned()->index('fk_comentarios_user1_idx');
			$table->integer('reply_id')->default(0);
            $table->integer('imagens_idimagens')->nullable()->index('fk_comentarios_imagens1_idx');
            $table->timestamps();

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comentarios');
	}

}

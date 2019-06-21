<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLivroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('livro', function(Blueprint $table)
		{
			$table->integer('idlivro', true);
			$table->string('nome', 45)->nullable();
			$table->float('valor', 10, 0)->nullable();
			$table->string('descricao', 45)->nullable();
			$table->boolean('comprado')->default(false);
			$table->date('ano')->nullable();
			$table->integer('imagens_idimagens')->nullable()->index('fk_livro_imagens1_idx');
			$table->foreign('imagens_idimagens', 'fk_livro_imagens1')->references('idimagens')->on('imagens')->onUpdate('CASCADE')->onDelete('CASCADE');

			$table->string('peso', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('livro');
	}

}

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
			$table->integer('idlivro')->primary();
			$table->string('nome', 45)->nullable();
			$table->float('valor', 10, 0)->nullable();
			$table->string('descricao', 45)->nullable();
			$table->date('ano')->nullable();
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

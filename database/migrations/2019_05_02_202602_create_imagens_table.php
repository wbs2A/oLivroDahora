<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imagens', function(Blueprint $table)
		{
			$table->integer('idimagens',true);
			$table->string('caminho', 45)->nullable();
			DB::table('imagens')->raw('ALTER TABLE  `imagens` ADD idcimagens INT PRIMARY KEY AUTO_INCREMENT;');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imagens');
	}

}

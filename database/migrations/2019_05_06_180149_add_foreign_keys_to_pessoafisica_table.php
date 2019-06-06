<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPessoafisicaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pessoafisica', function(Blueprint $table)
		{
			$table->foreign('Endereco_idEndereco', 'fk_pessoaFisica_Endereco1')->references('idEndereco')->on('endereco')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('imagens_idimagens', 'fk_pessoaFisica_imagens1')->references('idimagens')->on('imagens')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_iduser', 'fk_pessoaFisica_user1')->references('iduser')->on('user')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pessoafisica', function(Blueprint $table)
		{
			$table->dropForeign('fk_pessoaFisica_Endereco1');
			$table->dropForeign('fk_pessoaFisica_imagens1');
			$table->dropForeign('fk_pessoaFisica_user1');
		});
	}

}

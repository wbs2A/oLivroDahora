<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHasPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_has_post', function(Blueprint $table)
		{
			$table->foreign('post_idpost', 'fk_user_has_post_post1')->references('idpost')->on('post')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_iduser', 'fk_user_has_post_user1')->references('iduser')->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_has_post', function(Blueprint $table)
		{
			$table->dropForeign('fk_user_has_post_post1');
			$table->dropForeign('fk_user_has_post_user1');
		});
	}

}

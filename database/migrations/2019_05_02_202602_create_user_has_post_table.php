<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHasPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_has_post', function(Blueprint $table)
		{
			$table->integer('user_iduser')->unsigned()->index('fk_user_has_post_user1_idx');
			$table->integer('post_idpost')->index('fk_user_has_post_post1_idx');
			$table->primary(['user_iduser','post_idpost']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_has_post');
	}

}

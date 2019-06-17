<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostHasLivro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_has_livro', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('livro_id');
            $table->integer('post_id');
            $table->timestamps();
            $table->index(['post_id','livro_id'], 'fk_post_has_livro_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_has_livro');
    }
}

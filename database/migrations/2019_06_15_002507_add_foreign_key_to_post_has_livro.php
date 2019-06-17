<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToPostHasLivro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_has_livro', function (Blueprint $table) {
            $table->foreign('post_id', 'fk_post_has_livro_post1')->references('idpost')->on('post')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('livro_id', 'fk_post_has_livro_livro1')->references('idlivro')->on('livro')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_has_livro', function (Blueprint $table) {
            //
        });
    }
}

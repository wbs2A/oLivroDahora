<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post')->insert(
            array(
                array('titulo'=>"There's goting to be a musical about meghan", 'conteudo'=>"Creepeth green light appear let rule only you're divideand lights moving and isn't given creeping deep.Creepeth green light appear let rule only you're divide and lights moving and isn't given creeping deep.Creepeth green light appear let rule only you're divide and lights moving and isn't given creeping deep.Creepeth green light appear let rule only you're divide and lights moving and isn't given creeping deep.Creepeth green light appear let rule only you're divide and lights moving and isn't given creeping deep.", 'descricao'=>"Creepeth green light appear let rule only you're divide and lights moving and isn't given creeping deep.",'categoria_idcategoria1'=>1,'datapostagem'=>now()),
                array('titulo'=>"Forest responds to consultation smoking in al fresco.", 'conteudo'=>"Lorem ipsum do menino amet é Mussum Ipsum, cacilds vidis litro abertis. Suco de cevadiss deixa as pessoas mais interessantis. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis. Viva Forevis aptent taciti sociosqu ad litora torquent. Detraxit consequat et quo num tendi nada.",'descricao'=>"Creepeth green light appear let rule only you're divide and lights moving and isn't given creeping deep.",'categoria_idcategoria1'=>3,'datapostagem'=>now())
            ));
        // DB::table('pos_has_imagem')->insert(array(

        // ));
    }
}

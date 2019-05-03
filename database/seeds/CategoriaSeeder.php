<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria')->insert(array(
            array('nome'=>"Fashion"),
            array('nome'=>"Viagens"),
            array('nome'=>"Estilo de vida"),
            array('nome'=>"Finanças"),
            array('nome'=>"Comidinhas")
        ));
    }
}

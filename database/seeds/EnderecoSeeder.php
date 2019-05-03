<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('endereco')->insert(array('rua'=> 'rua lá de casa', 'bairro'=> 'de cima', 'cep'=> '00011-220', 'numero'=>13, 'Cidade_idCidade'=> 19));

    }
}

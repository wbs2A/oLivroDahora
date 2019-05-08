<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    protected $table = 'pessoafisica';
	protected $primaryKey = 'idpessoaFisica';
	public $incrementing = false;
	public $timestamps = false;
	public static function inserir($data){
    	$pessoa=new PessoaFisica();
    	$pessoa->idpessoaFisica=$data['cpf'];
    	$pessoa->sexo=$data['sexo'];
    	$pessoa->rg=$data['rg'];
    	$pessoa->dataNascimento=$data['nascimento'];
    	$pessoa->Endereco_idEndereco=$data['endereco'];
    	$pessoa->user_iduser=$data['user'];
        $pessoa->save();
        return $pessoa;
    }
    public static function atualizar($request, $id){}
}

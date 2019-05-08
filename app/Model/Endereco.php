<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Estado;
use App\Model\Cidade;

class Endereco extends Model
{
    protected $table = 'endereco';
    protected $primaryKey = 'idEndereco';
    public $incrementing = true;
    public $timestamps = false;
    public static function inserir($dados){
    	$estado= Estado::where('nome',$dados['estado'])->first();
    	$cidade=Cidade::where([['nome','=', $dados['cidade']],['Estado_idEstado','=',$estado->idEstado]])->first();
    	$endereco = new Endereco();
    	$endereco->bairro=$dados['bairro'];
    	$endereco->rua=$dados['rua'];
    	$endereco->cep=$dados['cep'];
    	$endereco->numero=$dados['numero'];
    	$endereco->Cidade_idCidade=$cidade->idCidade;
    	$endereco->save();
    	return $endereco;
    }
    public static function select($id=null){
    	if (is_null($id)) {
    		return self::all();
    	}else{
    		return self::find($id);
    	}
    }
    public static function alterar($dados){
        $estado= Estado::where('nome',$dados['estado'])->first();
        $cidade=Cidade::where([['nome','=', $dados['cidade']],['Estado_idEstado','=',$estado->idEstado]])->first();
        $endereco = Endereco::find($dados['idEndereco']);
        $endereco->bairro=$dados['bairro'];
        $endereco->rua=$dados['rua'];
        $endereco->cep=$dados['cep'];
        $endereco->numero=$dados['numero'];
        $endereco->Cidade_idCidade=$cidade->idCidade;
        $endereco->save();
        return $endereco;
    }
}

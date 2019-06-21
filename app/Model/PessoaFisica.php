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
        if (isset($data['imagem'])) {
            $pessoa->imagens_idimagens=$data['imagem'];
        }
        $pessoa->save();
        return $pessoa;
    }
    public static function atualizar($request, $id){}
    
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_iduser');
    }
    public function imagem()
    {
        return $this->hasOne(\App\Model\Imagens::class, 'idimagens','imagens_idimagens' );
    }
    public function pagamento(){
        return $this->belongsToMany(\App\Model\Pagamento::class, 'pessoafisica_has_pagamento', 'pessoafisica_idpessoaFisica', 'pagamento_idpagamento');
    }
    public function endereco()
    {
        return $this->belongsTo(\App\Model\Endereco::class, 'Endereco_idEndereco');
    }
}

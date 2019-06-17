<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pagamento';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idpagamento';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nCartao', 'vcc', 'formaPagamento', 'dataValidade'];
    
    public function compra()
    {
        return $this->belongsTo(\App\Model\Compra::class);
    }

    public function pessoaFisicas(){
        return $this->belongsToMany(\App\Model\PessoaFisica::class, 'pessoafisica_has_pagamento', 'pagamento_idpagamento', 'pessoafisica_idpessoaFisica');
    }
}

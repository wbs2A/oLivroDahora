<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
   	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'compra';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idcompra';
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
    protected $fillable = ['valor', 'data', 'realizado', 'livro_idlivro', 'pagamento_idpagamento'];
}

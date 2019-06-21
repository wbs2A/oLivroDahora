<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livro';
    protected $primaryKey = 'idlivro';
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
    protected $fillable = ['nome', 'valor', 'descricao', 'ano','peso','comprado', 'imagens_idimagens'];


    public function post(){
        return $this->belongsToMany(\App\Model\Post::class,'post_has_livro', 'post_id', 'livro_id');
    }
    public function vendedor(){
        return $this->belongsToMany(\App\User::class,'user_has_livro', 'user_iduser', 'livro_idlivro');
    }
    public function compra()
    {
        return $this->belongsTo(\App\Model\Compra::class);
    }
    public function imagem()
    {
        return $this->hasOne(\App\Model\Imagens::class, 'idimagens','imagens_idimagens' );
    }
}

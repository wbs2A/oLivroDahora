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
    public function post(){
        return $this->belongsToMany(\App\Model\Post::class,'post_has_livro','livro_id','idlivro');
    }
    public function compra()
    {
        return $this->belongsTo(\App\Model\Compra::class);
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livro';
    protected $primaryKey = 'idlivro';
    public function post(){
        return $this->belongsToMany(\App\Model\Post::class,'post_has_livro','livro_id','idlivro');
    }
}

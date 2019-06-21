<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Imagens extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'imagens';
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idimagens';

    protected $fillable = ['filename', 'mime', 'path', 'size'];
    public $timestamps = false;
    public function posts()
    {
        return $this->belongsToMany(\App\Model\Post::class, 'post_has_imagens', 'imagens_idimagens','post_idpost');
    }
    public function pessoaFisica()
    {
        return $this->belongsTo(\App\Model\PessoaFisica::class, 'imagens_idimagens','idimagens');
    }
    public function comentario()
    {
        return $this->belongsTo(\App\Model\Comentarios::class, 'imagens_idimagens','idimagens');
    }
    public function livro()
    {
        return $this->belongsTo(\App\Model\Livro::class, 'imagens_idimagens','idimagens');
    }
}

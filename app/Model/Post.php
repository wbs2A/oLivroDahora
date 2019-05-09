<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post';
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idpost';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    public static function buscaPostAll($data){
        return Post::join('categoria', 'post.categoria_idcategoria', '=', 'categoria.idcategoria')
            ->leftJoin('post_has_comentarios', 'post.idpost', '=', 'post_idpost')
            ->leftJoin('post_has_imagens', 'post.idpost', '=', 'post_has_imagens.post_idpost')
            ->leftJoin('imagens', 'imagens.idimagens', '=', 'imagens_idimagens')
            ->where('post.titulo', 'like', '%'.$data['busca'].'%')
            ->orWhere('post.descricao', 'like', '%'.$data['busca'].'%')
            ->orWhere('post.conteudo', 'like', '%'.$data['busca'].'%')
            ->select('post.titulo','post.descricao','post.datapostagem','post.idpost','post.titulo', 'categoria.nome as categoria','imagens.filename','imagens.mime','imagens.path','imagens.size', DB::raw('count(post_has_comentarios.post_idpost) as comentario'))
            ->groupBy('post.titulo','post.descricao','post.datapostagem','post.idpost','post.titulo', 'categoria','imagens.filename','imagens.mime','imagens.path','imagens.size')
            ->get();
    }
    public static function categoriaPosts($categoria=null){
        if ($categoria == null) {
            return Post::join('categoria', 'post.categoria_idcategoria', '=', 'categoria.idcategoria')
            ->leftJoin('post_has_comentarios', 'post.idpost', '=', 'post_has_comentarios.post_idpost')
            ->leftJoin('post_has_imagens', 'post.idpost', '=', 'post_has_imagens.post_idpost')
            ->leftJoin('imagens', 'imagens.idimagens', '=', 'imagens_idimagens')
            ->select('post.titulo','post.descricao','post.datapostagem','post.idpost','post.titulo', 'categoria.nome as categoria','imagens.filename','imagens.mime','imagens.path','imagens.size', DB::raw('count(post_has_comentarios.post_idpost) as comentario'))
            ->groupBy('post.titulo','post.descricao','post.datapostagem','post.idpost','post.titulo', 'categoria','imagens.filename','imagens.mime','imagens.path','imagens.size')
            ->get();    
        }
        return Post::join('categoria', 'post.categoria_idcategoria', '=', 'categoria.idcategoria')
            ->leftJoin('post_has_comentarios', 'post.idpost', '=', 'post_has_comentarios.post_idpost')
            ->leftJoin('post_has_imagens', 'post.idpost', '=', 'post_has_imagens.post_idpost')
            ->leftJoin('imagens', 'imagens.idimagens', '=', 'imagens_idimagens')
            ->where('categoria.idcategoria', '=', $categoria)
            ->select('post.titulo','post.descricao','post.datapostagem','post.idpost','post.titulo', 'categoria.nome as categoria','imagens.filename','imagens.mime','imagens.path','imagens.size', DB::raw('count(post_has_comentarios.post_idpost) as comentario'))
            ->groupBy('post.titulo','post.descricao','post.datapostagem','post.idpost','post.titulo', 'categoria','imagens.filename','imagens.mime','imagens.path','imagens.size')
            ->get();
    }

    public static function getPostById($id){
        return Post::join('categoria', 'post.categoria_idcategoria', '=', 'categoria.idcategoria')
            ->leftJoin('post_has_comentarios', 'post.idpost', '=', 'post_has_comentarios.post_idpost')
            ->leftJoin('post_has_imagens', 'post.idpost', '=', 'post_has_imagens.post_idpost')
            ->leftJoin('imagens', 'imagens.idimagens', '=', 'imagens_idimagens')
            ->where('post.idpost', '=', $id)
            ->select('post.titulo','post.descricao','post.conteudo','post.datapostagem','post.idpost','post.titulo', 'categoria.nome as categoria','imagens.filename','imagens.mime','imagens.path','imagens.size', DB::raw('count(post_has_comentarios.post_idpost) as comentario'))
            ->groupBy('post.titulo','post.descricao','post.conteudo','post.datapostagem','post.idpost','post.titulo', 'categoria','imagens.filename','imagens.mime','imagens.path','imagens.size')
            ->get();
    }
}
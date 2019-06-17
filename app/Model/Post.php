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
        return Post::where('post.titulo', 'like', '%'.$data['busca'].'%')
            ->orWhere('post.descricao', 'like', '%'.$data['busca'].'%')
            ->orWhere('post.conteudo', 'like', '%'.$data['busca'].'%')
            ->with(['comentarios','imagens','categoria'])->withCount('comentarios')
            ->orderBy('datapostagem','desc')
                ->paginate(5);
    }
    public static function categoriaPosts($categoria=null){
        if ($categoria == null) {
            return Post::with(['comentarios','imagens','categoria'])->withCount('comentarios')->orderBy('datapostagem','desc')
                ->paginate(5);
        }
        return Post::where('post.categoria_idcategoria', '=', $categoria)->with(['comentarios','imagens','categoria'])->withCount('comentarios')->orderBy('datapostagem','desc')->paginate(5);
    }
    private function teste($a,$b){
        if ($a['avaliacoes_r'][0]['qq'] == $b['avaliacoes_r'][0]['qq']) {
            return 0;
        }
        return ($a['avaliacoes_r'][0]['qq'] < $b['avaliacoes_r'][0]['qq']) ? -1 : 1;
    }
    public static function postsAvaliacao(){
        $t=Post::has('avaliacoes')->with(['comentarios','imagens','categoria','avaliacoesR'])
            ->limit(5)
            ->get();
            $t = $t->toArray();
            $e= usort($t,function($a,$b){
                if ($a['avaliacoes_r'][0]['qq'] == $b['avaliacoes_r'][0]['qq']) {
                    return 0;
                }
                return ($a['avaliacoes_r'][0]['qq'] > $b['avaliacoes_r'][0]['qq']) ? -1 : 1;
            });
        return $t;
    }
    public function avaliacoesR(){
        return $this->avaliacoes()
    ->selectRaw('sum(quantidade)/count(*) as qq')
    ->groupBy('post_idpost','avaliacao_idavaliacao');
}
 
    public static function getPostById($id){
        return Post::where('post.idpost', '=', $id)
            ->with(['comentarios','imagens','categoria','avaliacoes'])
            ->withCount('comentarios')
            ->get();
    }

    public function categoria()
    {
        return $this->belongsTo(\App\Model\Categoria::class, 'categoria_idcategoria');
    }
    public function comentarios()
    {
        return $this->belongsToMany(\App\Model\Comentarios::class, 'post_has_comentarios','post_idpost', 'comentarios_idcomentarios');
    }

    public function imagens()
    {
        return $this->belongsToMany(\App\Model\Imagens::class, 'post_has_imagens', 'post_idpost','imagens_idimagens');
    }

    public function avaliacoes()
    {
        return $this->belongsToMany(\App\Model\Avaliacao::class, 'post_has_avaliacao', 'post_idpost','avaliacao_idavaliacao');
    }
    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'user_has_post', 'post_idpost','user_iduser');
    }

    public function livros(){
        return $this->belongsToMany(\App\Model\Livro::class, 'post_has_livro', 'post_id', 'post_id');
    }
}
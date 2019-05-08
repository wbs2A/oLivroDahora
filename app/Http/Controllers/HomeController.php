<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $post;
        if (!(empty( $request->session()->get('request')))) {
            $data = $request->session()->get('request');
            $request->session()->forget('request');
            $post= Post::join('categoria', 'post.categoria_idcategoria1', '=', 'categoria.idcategoria')
            ->leftJoin('post_has_comentarios', 'post.idpost', '=', 'post_idpost')
            ->where('post.titulo', 'like', '%'.$data['busca'].'%')
            ->orWhere('post.descricao', 'like', '%'.$data['busca'].'%')
            ->orWhere('post.conteudo', 'like', '%'.$data['busca'].'%')
            ->select('post.titulo','post.descricao','post.datapostagem','post.idpost','post.titulo', 'categoria.nome as categoria', DB::raw('count(post_has_comentarios.post_idpost) as comentario'))
            ->groupBy('post.titulo','post.descricao','post.datapostagem','post.idpost','post.titulo', 'categoria')
            ->get();
        }else{
            $post= Post::join('categoria', 'post.categoria_idcategoria1', '=', 'categoria.idcategoria')
            ->leftJoin('post_has_comentarios', 'post.idpost', '=', 'post_idpost')
            ->select('post.titulo','post.descricao','post.datapostagem','post.idpost','post.titulo', 'categoria.nome as categoria', DB::raw('count(post_has_comentarios.post_idpost) as comentario'))
            ->groupBy('post.titulo','post.descricao','post.datapostagem','post.idpost','post.titulo', 'categoria')
            ->get();
        }
        return view('index', ['post' => $post]);
    }
    public function busca(Request $request){
        $request->session()->put('request', $request->all());
        return redirect()->action("HomeController@index");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Model\Categoria;

class HeaderController extends Controller
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
        $categoria = Categoria::withCount('post')->get();
        if (!(empty($request->all()))) {
            $data = $request->all();
            $post= Post::buscaPostAll($data);
        }else{
            $post= Post::categoriaPosts();
        }
        $postsL= Post::postsAvaliacao();
        return view('index', ['post' => $post, 'categoria' =>$categoria, 'postsL'=>$postsL]);
    }
    public function showCarrinho(){
        
        return view('carrinho');
    }
    public function getcategoriaPost(Request $request){
        if (isset($request->all()['categoria'])) {
            return response()->json(Post::categoriaPosts($request->all()['categoria'])) ;
        }
        return response()->json(Post::categoriaPosts()) ;
    }
    public function categoria(Request $request) {
        $categoria = Categoria::all();
        $postsL= Post::postsAvaliacao();
        if (isset($request->all()['id'])) {
            // dd($request->all()['id']);
            $post= Post::categoriaPosts($request->all()['id']);
        }else{
            $post= Post::categoriaPosts();
        }
        return view('categoria', ['categoria' => $categoria, 'post' => $post , 'postsL'=>$postsL]);

    }
}

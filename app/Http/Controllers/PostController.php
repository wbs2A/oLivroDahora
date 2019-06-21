<?php

namespace App\Http\Controllers;

use App\Model\Post;
use App\Model\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Auth;
use App\User;   
use App\Model\PostHasImagens;
use App\Model\Livro;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request);
        $id = DB::table('post')->insertGetId(['titulo'=>$request->title, 'descricao'=>$request->descricao, 'conteudo'=>$request->conteudo, 'datapostagem'=>now(), 'categoria_idcategoria'=>2]);
        DB::table('user_has_post')->insert(['user_iduser'=>\Illuminate\Support\Facades\Auth::user()->iduser, 'post_idpost'=>$id]);
        if (!empty($request->file('imagem'))) {
            $imagem = $this->insertImagem($request);
           PostHasImagens::create(['post_idpost' => $id,'post_categoria_idcategoria' => 2,'imagens_idimagens' => $imagem]);
        }
       return redirect()->to('/admin/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id, Post $post)
    {
        $categoria = Categoria::withCount('post')->get();
        $post = Post::getPostById($id);
        $postsL= Post::postsAvaliacao();
        $livro = Livro::where('comprado', 0)->whereHas('post',function($q) use($id){
            $q->where('post_id', $id);
        })->with(['imagem','post'])->first();
        if (\Illuminate\Support\Facades\Auth::check()) {
            return view('viewpost',['post'=>$post, 'categoria' =>$categoria, 'postsL'=>$postsL, 'user' => User::where('iduser',\Illuminate\Support\Facades\Auth::user()->iduser)->with(['pessoaFisica.imagem'])->first(), 'livro' =>$livro]);
        }else{
            return view('viewpost',['post'=>$post, 'categoria' =>$categoria, 'postsL'=>$postsL, 'livro' =>$livro]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Post $post)
    {
        $post = Post::getPostById($id);
        return view('admin.createPost', ['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Post $post)
    {
        $t= PostHasImagens::where('post_idpost', $id)->get();
        $key = $t[0]->imagens_idimagens;
        $this->deleteimagem($key);
        PostHasImagens::where('post_idpost', $id)->delete();
        DB::table('user_has_post')->where('post_idpost', $id)->delete();
        Post::find($id)->delete();
        return redirect()->to('/admin/posts');
    }

    public function getPostByUser(){
        return Post::getPostByUserId(\Illuminate\Support\Facades\Auth::user()->iduser);
    }

    public function getPosts(){
        $posts = \Illuminate\Support\Facades\Auth::user()->posts()->get();
        return view('admin.viewPosts')->with(['Posts'=>$posts]);
    }

}

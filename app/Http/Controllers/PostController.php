<?php

namespace App\Http\Controllers;

use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Auth;

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
       $id = DB::table('post')->insertGetId(['titulo'=>$request->title, 'descricao'=>$request->descricao, 'conteudo'=>$request->conteudo, 'datapostagem'=>now(), 'categoria_idcategoria'=>$request->categoria]);
       DB::table('user_has_post')->insert(['user_iduser'=>\Illuminate\Support\Facades\Auth::user()->iduser, 'post_idpost'=>$id]);
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
        $post = Post::getPostById($id);
        return view('viewpost',['post'=>$post]);
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
        return view('createpost', ['post'=>$post]);
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
        Post::find($id)->delete();
        return redirect()->to('/perfil');
    }

    public function getPostByUser(){
        return Post::getPostByUserId(\Illuminate\Support\Facades\Auth::user()->iduser);
    }

}

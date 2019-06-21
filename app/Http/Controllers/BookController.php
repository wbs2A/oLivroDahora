<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Post;
use App\Model\Livro;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($all = null)
    {
        if ($all == null) {
            $iduser = Auth::user()->iduser;
            $posts = Post::orWhereDoesntHave('livros')->whereHas('users', function ($q) use($iduser){
                $q->where('iduser', $iduser);
            })->get();
            return view('admin.viewPostBook')->with([
                'posts' => $posts
            ]);
        }else{
            $posts = Auth::user()->posts()->get();
            return view('admin.viewPostBook')->with([
                'posts' => $posts
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user()->iduser;
        $action='insertBook';
        $post=Post::where('idpost', $id)->with(['users' => function ($q) use($user)
        {
            $q->where('user_iduser', $user);
        }])->first();
        $livro = $post->livros()->with(['imagem'])->get();
        // dd(!empty($livro[0]));
        if (empty($post)) {
            return redirect()->route('viewPostBook');
        }
        if (!empty($livro[0])) {
            $livro=$livro[0];
            $action='updateBook';
            $livro->ano=Carbon::parse($livro->ano)->format('Y');
            return view('admin.createBook')->with([
                'post' => $livro->idlivro,
                'a' => $action,
                'livro' => $livro
            ]);
        }
        return view('admin.createBook')->with([
                'post' => $id,
                'a' => $action
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $post=Post::where('idpost', $id)->first();
        $user =$post->users()->get();
        $data= $request->all();
        $data['ano'] = $data['ano'].'-01-01';
        if (!empty($request->file('imagem'))) {
            $data['imagens_idimagens'] = $this->insertImagem($request);
        }
        // dd($data);
        $livro = Livro::create($data);
        DB::table('post_has_livro')->insert(['livro_id'=> $livro->idlivro, 'post_id'=> $id]);
        DB::table('user_has_livro')->insert(['livro_idlivro'=> $livro->idlivro, 'user_iduser'=> $user[0]->iduser]);
        return redirect()->route('viewPostBook');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data= $request->except('_token');
        // dd($data);
        $livro = Livro::find($id);
        $data['ano'] = $data['ano'].'-01-01';
        if (!empty($request->file('imagem'))) {
            $this->updateImagem($livro->imagens_idimagens, $request);
        }
        $livro = Livro::where('idlivro',$id)->update($data);
        return redirect()->route('viewPostBook');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true]);

Route::get('/', 'HeaderController@index')->name('home');
Route::get('/home', function (){
    return redirect()->to('/');
});
Route::get('/contato', function () {
    return view('contato');
})->name('contato');

Route::get('/categoria', 'HeaderController@categoria' )->name('categoria');
Route::post('/categoria', 'HeaderController@categoria' )->name('categoria');

Route::post('/busca', 'HeaderController@index')->name('busca');

Route::group(['middleware'=>["web","verified"]], function (){
    Route::get('/api/chat/getChat/{id}', 'ChatController@getChat');
    Route::post('/api/chat/sendChat', 'ChatController@sendChat')->middleware('auth');
	// Route::post('/busca', 'HeaderController@index')->name('busca');
	
	// Route::get('/contato', function () {
	//     return view('contato');
	// })->name('contato');
	// Route::get('/categoria', 'HeaderController@categoria' )->name('categoria');
 //    Route::post('/categoria', 'HeaderController@categoria' )->name('categoria');    
    Route::get('/carrinho', 'HeaderController@showCarrinho')->name('carrinho');

    Route::get('/createpost', 'PostController@create');
    Route::get('deletepost/{id}', 'PostController@destroy');

    Route::redirect('/perfil/post','/perfil');

    Route::group(['prefix'=>'api/', 'middleware'=>'api'], function (){
        Route::get('userInsertCpf/{id}', 'UserController@show');
        Route::post('/getcategoriaPost', 'HeaderController@getcategoriaPost');
        Route::get('/getcategoriaPost', 'HeaderController@getcategoriaPost');  
        Route::get('/getIdFisica', 'UserController@getIdPessoa');
        Route::get('/getPFisica/{cpf}', 'PessoaFisicaController@show');
        Route::post('/updateDadosPessoaisPessoaFisica/{cpf}/{interno?}', 'PessoaFisicaController@updateDados');
        Route::post('/updateDadosPessoaisEndereco/{id}/{interno?}','PessoaFisicaController@alteraEndereco');
        Route::post('/updateDadosPessoaisUser/{id}', 'UserController@alteraEmailSenha');
        Route::post('insertPost/', 'PostController@store')->name('submit');
        Route::post('updatePost/{id}', 'PostController@update')->name('updatePost');
        Route::get('getPostUser/', 'PostController@getPostByUser');
    });
    Route::get('viewpost/{id}', "PostController@show");

});
	 //Rota de logout personalizado
    Route::get('/logout', 'Auth\LoginController@logout')->middleware('auth');

    Route::group(['prefix'=>'api/', 'middleware'=>'api'], function (){
        Route::get('userInsertCpf/{id}', 'UserController@show');
        Route::post('/getcategoriaPost', 'HeaderController@getcategoriaPost');
        Route::get('/getcategoriaPost', 'HeaderController@getcategoriaPost');
    });
Route::get('/perfil', 'UserController@index')->name('perfil')->middleware('auth');
Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');



Route::group(['prefix'=>'admin/', 'middleware'=>['auth','verified']], function(){
    Route::get('/','HomeController@index');
    Route::get('home', 'HomeController@index')->name('dashboard');
    Route::get('createpost',['uses'=>'PostController@create']);
    Route::get('updatepost',['uses'=>'PostController@edit']);
    Route::get('/posts', 'PostController@getPosts')->name('posts');
    Route::get('/chat', 'ChatController@index')->middleware('auth');
    Route::get('/chat/{id}', 'ChatController@show')->middleware('auth')->name('chat.show');
    Route::get('/removePost/{id}', 'PostController@destroy')->name('removePost');
    Route::get('/editpost/{id}','PostController@edit')->name('editPost');
    Route::get('/viewpostbook/{all?}', 'BookController@index')->name('viewPostBook');
    Route::get('/createbook/{id}', 'BookController@create')->name('insertBook');
    Route::get('/updatebook/{id}', 'BookController@edit')->name('updateBook');
    Route::post('/createbook/{id}', 'BookController@store')->name('insertBook');
    Route::post('/updatebook/{id}', 'BookController@update')->name('updateBook');
});



Route::group(['prefix'=>'api/', 'middleware'=>'api'], function (){
    Route::get('comentarios/{id}', 'CommentController@index');
    Route::post('/comentario', 'CommentController@store');
    Route::post('/ucomentario/{commentId}', 'CommentController@update');
    Route::post('/comentario/imagem', 'UserController@postimagem');
    Route::delete('/comentario/imagem/{id}', 'UserController@deleteimagem');
    Route::get('/comentario/{id}/{idpost}', 'CommentController@getComentario');
    Route::post('/avaliacao', 'AvaliacoesController@store');
    Route::post('/avaliacao/{id}', 'AvaliacoesController@update');
    Route::get('/carrinho', 'CarrinhoController@show');
    Route::post('/carrinho', 'CarrinhoController@store');
    Route::get('/carrinho/{id}', 'CarrinhoController@destroy');
    Route::post('/addFriend', function (Request $request){
        try{
            $friend = \App\User::where('name','=',$request->nome)->firstOrFail();
            \Illuminate\Support\Facades\DB::table('friends')->insert(['user_id'=>Auth::user()->iduser, 'friend_id'=>$friend->iduser]);
            \Illuminate\Support\Facades\DB::table('friends')->insert(['friend_id'=>Auth::user()->iduser, 'user_id'=>$friend->iduser]);
            return redirect('/admin/chat')->with('success','Amigo adicionado com sucesso.');
        }catch (\Exception $e){
            return redirect('/admin/chat')->withErrors(['Não foi possível adicionar o amigo! Certifique o nome e tente novamente.']);
        }

    });
});
Route::post('/carrinho-finaliza', 'CarrinhoController@finaliza');
Route::post('/compra/finaliza', 'CarrinhoController@compra')->name('compra');
Route::delete('/api/comentario/{id}', 'CommentController@deleteComentario');
Route::post('api/register/imagem', 'UserController@postimagem');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    '\vendor\uniSharp\LaravelFilemanager\Lfm::routes()';
});
Route::get('/mailable', function () {
    $user = App\User::find(1);
    $c = App\Model\Compra::where('realizado', 1)->get();
    return new App\Mail\Email($user, $c);
});
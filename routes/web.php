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
	Route::post('/busca', 'HeaderController@index')->name('busca');
	
	// Route::get('/contato', function () {
	//     return view('contato');
	// })->name('contato');
	// Route::get('/categoria', 'HeaderController@categoria' )->name('categoria');
 //    Route::post('/categoria', 'HeaderController@categoria' )->name('categoria');    
    Route::get('/carrinho', 'UserController@showCarrinho')->name('carrinho');

    Route::get('/createpost', 'PostController@create');
    Route::get('deletepost/{id}', 'PostController@destroy');

    Route::redirect('/perfil/post','/perfil');

    Route::group(['prefix'=>'api/', 'middleware'=>'api'], function (){
        Route::get('userInsertCpf/{id}', 'UserController@show');
        Route::post('/getcategoriaPost', 'HeaderController@getcategoriaPost');
        Route::get('/getcategoriaPost', 'HeaderController@getcategoriaPost');  
        Route::get('/getIdFisica', 'UserController@getIdPessoa');
        Route::get('/getPFisica/{cpf}', 'PessoaFisicaController@show');
        Route::post('/updateDadosPessoaisPessoaFisica/{cpf}', 'PessoaFisicaController@updateDados');
        Route::post('/updateDadosPessoaisEndereco/{id}','PessoaFisicaController@alteraEndereco');
        Route::post('/updateDadosPessoaisUser/{id}', 'UserController@alteraEmailSenha');
        Route::post('insertPost/', 'PostController@store')->name('submit');
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
    Route::get('/posts', 'PostController@getPosts')->name('posts');
    Route::get('/chat', 'ChatController@index')->middleware('auth');
    Route::get('/chat/{id}', 'ChatController@show')->middleware('auth')->name('chat.show');
    Route::get('/removePost/{id}', 'PostController@destroy')->name('removePost');
    Route::get('/editpost/{id}','PostController@edit')->name('editPost');
    Route::get('/createbook', 'BookController@create')->name('insertBook');
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
});
Route::delete('/api/comentario/{id}', 'CommentController@deleteComentario');
Route::post('api/register/imagem', 'UserController@postimagem');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    '\vendor\uniSharp\LaravelFilemanager\Lfm::routes()';
});

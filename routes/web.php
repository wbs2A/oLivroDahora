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
Auth::routes();
Route::get('/', 'HeaderController@index')->name('home');
Route::get('/home', function (){
    return redirect()->to('/');
});
Route::get('/contato', function () {
    return view('contato');
})->name('contato');

Route::get('/categoria', 'HeaderController@categoria' )->name('categoria');

Route::post('/busca', 'HeaderController@busca')->name('busca');

Route::group(['middleware'=>["web"]], function (){
	Route::get('/', 'HeaderController@index')->name('home');

	Route::post('/busca', 'HeaderController@busca')->name('busca');
	
	Route::get('/contato', function () {
	    return view('contato');
	})->name('contato');
	Route::get('/categoria', 'HeaderController@categoria' )->name('categoria');
    Route::get('/perfil', 'UserController@index')->name('perfil');
    Route::get('/carrinho', 'UserController@showCarrinho')->name('carrinho');

    Route::get('/createpost', 'PostController@create');
    Route::get('/editpost/{id}','PostController@edit');
    Route::get('deletepost/{id}', 'PostController@destroy');

    Route::redirect('/perfil/post','/perfil');

    Route::group(['prefix'=>'api/', 'middleware'=>'api'], function (){
        Route::get('userInsertCpf/{id}', 'UserController@show');
        Route::post('/getcategoriaPost', 'HeaderController@getcategoriaPost');
        Route::get('/getIdFisica', 'UserController@getIdPessoa');
        Route::get('/getPFisica/{cpf}', 'PessoaFisicaController@show');
        Route::post('/updateDadosPessoaisPessoaFisica/{cpf}', 'PessoaFisicaController@updateDados');
        Route::post('/updateDadosPessoaisEndereco/{id}','PessoaFisicaController@alteraEndereco');
        Route::post('/updateDadosPessoaisUser/{id}', 'UserController@alteraEmailSenha');
        Route::post('insertPost/', 'PostController@store')->name('submit');
        Route::get('getPostUser/', 'PostController@getPostByUser');
    });
	 //Rota de logout personalizado
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('viewpost/{id}', "PostController@show");

});
Route::group(['prefix'=>'api/', 'middleware'=>'api'], function (){
    Route::get('userInsertCpf/{id}', 'UserController@show');
    Route::post('/getcategoriaPost', 'HeaderController@getcategoriaPost');
});
Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');


Auth::routes();

Route::group(['prefix'=>'admin/', 'middleware'=>'auth'], function(){
    Route::get('home', 'HomeController@index')->name('dashboard');
    Route::get('createpost',['uses'=>'PostController@create']);
    Route::get('/chat', 'ChatController@index')->middleware('auth');
    Route::get('/chat/{id}', 'ChatController@show')->middleware('auth')->name('chat.show');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    '\vendor\uniSharp\LaravelFilemanager\Lfm::routes()';
});
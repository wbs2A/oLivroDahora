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
Route::get('/home', 'HeaderController@index')->name('home');

Route::get('/contato', function () {
    return view('contato');
})->name('contato');

Route::get('/categoria', 'HeaderController@categoria' )->name('categoria');

Route::post('/busca', 'HeaderController@busca')->name('busca');

Route::group(['middleware'=>["web"]], function (){
	Route::get('/', 'HeaderController@index')->name('home');
	Route::get('/home', 'HeaderController@index')->name('home');

	Route::post('/busca', 'HeaderController@busca')->name('busca');
	
	Route::get('/contato', function () {
	    return view('contato');
	})->name('contato');
	Route::get('/categoria', 'HeaderController@categoria' )->name('categoria');
    Route::get('/perfil', 'UserController@index')->name('perfil');
    Route::get('/carrinho', 'UserController@showCarrinho')->name('carrinho');

    Route::group(['prefix'=>'api/', 'middleware'=>'api'], function (){
        Route::get('userInsertCpf/{id}', 'UserController@show');
        Route::post('/getcategoriaPost', 'HeaderController@getcategoriaPost');
    });
	 //Rota de logout personalizado
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('viewpost/{id}', "PostController@show");

});


Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');

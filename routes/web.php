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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contato', function () {
    return view('contato');
})->name('contato');

Route::get('/categoria', function () {
    return view('categoria');
})->name('categoria');

Route::post('/busca', 'HomeController@busca')->name('busca');

Route::group(['middleware'=>["web"]], function (){
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/home', 'HomeController@index')->name('home');

	Route::post('/busca', 'HomeController@busca')->name('busca');
	
	Route::get('/contato', function () {
	    return view('contato');
	})->name('contato');
	Route::get('/categoria', function () {
	    return view('categoria');
	})->name('categoria');
    Route::get('/perfil', 'UserController@index')->name('perfil');
    Route::get('/carrinho', 'UserController@showCarrinho')->name('carrinho');
    Route::group(['prefix'=>'api/', 'middleware'=>'api'], function (){
        Route::get('userInsertCpf/{id}', 'UserController@show');
    });
	 //Rota de logout personalizado
    Route::get('/logout', 'Auth\LoginController@logout');

});


Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');

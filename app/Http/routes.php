<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::auth();
Route::get('/home', 'HomeController@index');

//Rotas de AJAX
Route::post('/ajax/subcategorias_listar', 'AjaxController@subcategorias_listar');

//Rotas de Contato
Route::get('/contatos', 'ContatoController@index');
Route::get('/contatos/ver_contato/{contato}', 'ContatoController@mostra_contato');
Route::post('/contatos/add', 'ContatoController@add');
Route::get('/contatos/{contato}/edit', 'ContatoController@edit');
Route::get('/contatos/delete/{contato}', 'ContatoController@delete');
Route::patch('/contatos/update/{contato}', 'ContatoController@update');
Route::get('/contatos/imagem/{contato}', 'ContatoController@imagem');
Route::patch('/contatos/imagem/{contato}', 'ContatoController@imagem_cadastrar');
Route::get('/contatos/imagem/{contato}/delete', 'ContatoController@delete_imagem');
Route::get('/contatos/todos', 'ContatoController@all');
Route::post('/contatos/todos', 'ContatoController@all');

//Rotas de Categorias
Route::get('/categorias', 'CategoriaController@index');
Route::post('/categorias/add', 'CategoriaController@add');
Route::get('/categorias/delete/{categoria}', 'CategoriaController@delete');
Route::get('/categorias/{categoria}/edit', 'CategoriaController@edit');
Route::patch('/categorias/update/{categoria}', 'CategoriaController@update');

//Rotas de Subcategoria
Route::get('/subcategorias/{categoria}', 'SubcategoriaController@index');
Route::post('/subcategorias/add/{categoria}', 'SubcategoriaController@add');
Route::get('/subcategorias/{subcategoria}/edit', 'SubcategoriaController@edit');
Route::patch('/subcategorias/update/{subcategoria}', 'SubcategoriaController@update');
Route::get('/subcategorias/delete/{subcategoria}', 'SubcategoriaController@delete');


//Rotas de usuarios
Route::get('/users', 'UserController@index');
Route::post('/users/add', 'UserController@add');
Route::get('/users/{user}/edit', 'UserController@edit');
Route::patch('/users/update/{user}/', 'UserController@update');
Route::get('/users/delete/{user}', 'UserController@delete');

//Rotas de permissões
Route::get('/permissoes/{user}', 'PermissaoController@index');
Route::post('/permissoes/add/{user}', 'PermissaoController@add');


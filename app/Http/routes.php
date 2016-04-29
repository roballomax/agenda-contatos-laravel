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

//Rotas de Contato
Route::get('/contatos', 'ContatoController@index');

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

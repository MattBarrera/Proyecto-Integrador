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

Route::get('/', 'StoreController@indexHome');
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/Store', 'StoreController@index');
Route::get('/Busqueda','ProductoController@Busqueda');
	// Route::resource('Productos','ProductoController',['middleware'=>'guest','only' => ['show']]);
Route::auth();

Route::group(['middleware'=>'auth'], function(){

	Route::resource('Productos','ProductoController');
	Route::resource('User','UserController');
	Route::resource('Productos/{id}/Baja','ProductoController@Baja');
	Route::resource('Productos/{id}/ReActivar','ProductoController@ReActivar');
	Route::get('/MyProducts','ProductoController@indexOwn');
	Route::get('/MyHistoricProducts','ProductoController@OwnDown');
	Route::resource('Empresa','EmpresaController');

	Route::get('/getSubCategorias/{id}','ProductoController@getSubCategorias');

});

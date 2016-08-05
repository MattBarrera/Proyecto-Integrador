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

Route::auth();
Route::get('/', 'StoreController@indexHome');
Route::get('/Store', 'StoreController@index');
	Route::get('/Follow/{id}', 'UserController@follow');
	Route::get('/Busqueda','ProductoController@Busqueda');

Route::group(['middleware'=>'auth'], function(){
	// Route::resource('Productos','ProductoController');
	Route::post('/Productos','ProductoController@store');
	Route::get('Productos/create','ProductoController@create');
	Route::post('Productos/{id}','ProductoController@destroy');
	Route::post('Productos/{id}','ProductoController@update');
	Route::post('Productos/{id}/Baja','ProductoController@Baja');
	Route::post('Productos/{id}/edit','ProductoController@edit');
	Route::get('Productos/{id}/ReActivar','ProductoController@ReActivar');
	Route::get('/MyProducts','ProductoController@indexOwn');
	Route::get('/MyHistoricProducts','ProductoController@OwnDown');
	Route::get('/MyPersonalProducts','ProductoController@followersProducts');
	Route::get('/getSubCategorias/{id}','ProductoController@getSubCategorias');

	Route::resource('User','UserController');
	Route::resource('Empresa','EmpresaController');
});

	Route::get('Productos/{id}','ProductoController@Show');


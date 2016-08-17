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
	Route::get('/Busqueda','ProductoController@Busqueda');
	
	Route::get('/Terms',function(){
		return view('Terms');
	});
	// Route::get('/terminosYCondiciones', function(){
	// 	return view('terminosYCondiciones')
	// });

Route::group(['middleware'=>'auth'], function(){
	// Route::resource('Productos','ProductoController');
	Route::post('/Productos','ProductoController@store');
	Route::get('/Productos/create','ProductoController@create');
	Route::post('/Productos/{id}','ProductoController@destroy');
	Route::post('/Productos/{id}','ProductoController@update');
	Route::post('/Productos/{id}/Baja','ProductoController@Baja');
	Route::get('/Productos/{id}/ReActivar','ProductoController@ReActivar');
	Route::get('/Productos/{id}/edit','ProductoController@edit');
	Route::get('/MyProducts','ProductoController@indexOwn');
	Route::get('/MyHistoricProducts','ProductoController@OwnDown');
	Route::get('/MyPersonalProducts','ProductoController@followersProducts');
	Route::get('/getSubCategorias/{id}','ProductoController@getSubCategorias');
	Route::get('/Follow/User/{id}', 'FollowerController@followUser');
	Route::get('/Follow/Empresa/{id}', 'FollowerController@followEmpresa');



	Route::resource('/User','UserController');
	Route::resource('/Stock','StockController');
	Route::get('/getTalles/{id}/{productoId}','ProductoController@getTalles');
	Route::resource('/Empresa','EmpresaController');
	Route::get('/Empresa/{id}/addAdmin','EmpresaController@addAdmin');
	Route::post('/Empresa/{id}','EmpresaController@storeAdmin');
	Route::delete('/Empresa/{id}/destroyAdmin','EmpresaController@destroyAdmin');

	Route::resource('/Generos','GeneroController');
	Route::resource('/Colores','ColorController');
	Route::resource('/Talles','TalleController');
	Route::resource('/Categorias','CategoriaController');
	Route::resource('/SubCategorias','SubCategoriaController');
	Route::get('/Shop','ShopController@index')->name('Shop.index');
	Route::get('/Shop/CheckOut','ShopController@CheckOut')->name('Shop.CheckOut');
	Route::get('/Shop/CheckOutFinal','ShopController@CheckOutFinal')->name('Shop.CheckOutFinal');
});
	Route::get('/Productos/{id}','ProductoController@Show');
	// Route::resource('/Shop','ShopController');

	Route::get('/Shop','ShopController@index')->name('Shop.index');
	Route::post('/Shop','ShopController@store')->name('Shop.store');
	Route::patch('/Shop/{id}','ShopController@update')->name('Shop.update');
	Route::delete('/Shop/{id}','ShopController@destroy')->name('Shop.destroy');

	Route::get('/Whishlist','WhishlistController@index')->name('Whishlist.index');
	Route::post('/Whishlist','WhishlistController@store')->name('Whishlist.store');
	Route::delete('/Whishlist/{id}','WhishlistController@destroy')->name('Whishlist.destroy');
	Route::post('/Whishlist/{id}/update','WhishlistController@update')->name('Whishlist.update');
	Route::get('/Whishlist/{id}/switchToCart','WhishlistController@switchToCart')->name('Whishlist.switchToCart');
	

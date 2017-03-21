<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});


Route::get('prueba', function(){
	return "Hola desde routes.php";
});

Route::get('nombre/{nombre}', function ($nombre){
	return "Hola mi nombre es: " . $nombre;

});

Route::get('edad/{edad?}', function($edad = 27){
		return "Hola mi edad es: " . $edad;
	});

Route::get('controlador','PruebaController@index');

Route::get('name/{nombre}','PruebaController@nombre');

Route::resource('movie','MovieController');
*/

Route::get('/','FrontController@index');
Route::get('contacto','FrontController@contacto');
Route::get('reviews','FrontController@reviews');
Route::get('admin','FrontController@admin');

Route::get('password/email','Auth\PasswordController@getEmail');
Route::post('password/email','Auth\PasswordController@postEmail');

Route::get('password/reset/{token}','Auth\PasswordController@getReset');
Route::post('password/reset','Auth\PasswordController@postReset');

Route::resource('mail','MailController');
Route::resource('usuario','UsuarioController');
Route::resource('genero','GeneroController');
Route::get('generos', 'GeneroController@listing');

Route::resource('pelicula','MovieController');


Route::resource('log','LogController');
Route::get('logout','LogController@logout');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
 
 Route::auth();
 Route::resource('log', 'LogController');
 Route::get('/', 'FrontController@index');
 Route::resource('usuario', 'UsuarioController');
 Route::resource('genero', 'GeneroController');
 Route::get('/contacto', 'FrontController@contacto');
 Route::get('/reviews', 'FrontController@reviews');
 Route::get('/admin', 'FrontController@admin');
 Route::get('logout', 'LogController@logout');
 Route::resource('pelicula','MovieController');
 Route::resource('mail','MailController');
 
 Route::get('password/email','Auth\PasswordController@getEmail');
Route::post('password/email','Auth\PasswordController@postEmail');

Route::get('password/reset/{token}','Auth\PasswordController@getReset');
Route::post('password/reset','Auth\PasswordController@postReset');

});
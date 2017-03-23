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

Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');
Route::get('login/facebook', 'Auth\AuthController@redirectToFacebook');
Route::get('login/facebook/callback', 'Auth\AuthController@getFacebookCallback');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/blog', 'BlogController@index');
Route::get('/blog/{slug?}', 'BlogController@show');
Route::post('/comment', 'CommentsController@newComment');
Route::get('json', function () {
	return App\Post::paginate();
});

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {
    Route::get('users', [ 'as' => 'admin.user.index', 'uses' => 'UsersController@index']);
    Route::get('users/{id?}/edit', 'UsersController@edit');
	Route::post('users/{id?}/edit','UsersController@update');
	Route::get('/', 'PagesController@home');
    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/create', 'RolesController@store');
    Route::get('posts', 'PostsController@index');
	Route::get('posts/create', 'PostsController@create');
	Route::post('posts/create', 'PostsController@store');
	Route::get('posts/{id?}/edit', 'PostsController@edit');
	Route::post('posts/{id?}/edit','PostsController@update');
	Route::get('categories', 'CategoriesController@index');
	Route::get('categories/create', 'CategoriesController@create');
	Route::post('categories/create', 'CategoriesController@store');

});

Auth::routes();

Route::get('/home', 'HomeController@index');

<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'laravel-filemanager'], function () {
	\UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware('auth')->group(function(){
	Route::get('dashboard', 'DashboardController@show');

	Route::get('admin', 'DashboardController@show');

	//USER
	Route::get('admin/user/list', 'AdminUserController@list');
	Route::get('admin/user/add', 'AdminUserController@add');
	Route::post('admin/user/store', 'AdminUserController@store');
	Route::get('admin/user/edit/{id}', 'AdminUserController@edit')->name('user.edit');
	Route::post('admin/user/update/{id}', 'AdminUserController@update')->name('user.update');
	Route::get('admin/user/delete/{id}', 'AdminUserController@delete')->name('delete_user');
	Route::get('admin/user/action', 'AdminUserController@action');

 	//Page
	Route::get('admin/page/list', 'PageController@list');
	Route::get('admin/page/add', 'PageController@add');
	Route::post('admin/page/store', 'PageController@store');
	Route::get('admin/page/edit/{id}', 'PageController@edit')->name('page.edit');
	Route::post('admin/page/update/{id}', 'PageController@update')->name('page.update');
	Route::get('admin/page/delete/{id}', 'PageController@delete')->name('page.delete');

	// POST
	Route::resource('postAjax', 'PostController');
	// catPost
	Route::get('admin/post/cat/list', 'CatPostController@list');
	Route::post('admin/post/cat/add', 'CatPostController@add')->name('catPost.add');
	Route::get('admin/post/cat/edit/{id}', 'CatPostController@edit')->name('catPost.edit');
	Route::put('admin/post/cat/update/{id}', 'CatPostController@update')->name('catPost.update');
	Route::delete('admin/post/cat/delete/{id}', 'CatPostController@delete')->name('catPost.delete');
});
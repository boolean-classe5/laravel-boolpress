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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{slug}', 'PostController@show')->name('posts.show');
Route::get('/categories/{slug}', 'PostController@postInCategory')->name('posts.category');
Route::post('/posts-by-author', 'PostController@filterPostsByAuthor')->name('posts.filterByAuthor');
Route::get('/author/{auhtor_name}', 'PostController@postByAuthor')->name('posts.author');
Auth::routes();

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function() {
  Route::get('/', 'HomeController@index')->name('home');
  Route::resource('/posts', 'PostController');
});

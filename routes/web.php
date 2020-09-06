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

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@home');
Route::get('blog/{post}', 'PostsController@show')->name('posts.show');
Route::get('categoria/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');

Route::get('posts', function(){
    return App\Post::all();
});
Route::get('posts_prueba', function(){
    return App\Post::findByUrl('mi-primer-post');
});

//Route::get('home', function() {
//    return view('admin.dashboard');
//})->middleware('auth');

Route::auth(['register' => true]);

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('posts', 'PostsController@index')->name('admin.posts.index');
    Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
    Route::post('posts', 'PostsController@store')->name('admin.posts.store');
    Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
    Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
    Route::delete('posts/{post}', 'PostsController@destroy')->name('admin.posts.destroy');
    Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
    Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');
});

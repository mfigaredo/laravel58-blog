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

//DB::listen(function($query) {
//   var_dump($query->sql);
//   echo '<br>';
//});

Route::get('laravel', function() {
    return view('welcome');
});

//Route::get('email', function() {
//    return new App\Mail\LoginCredentials(App\User::first(), 'asd123');
//});

Route::group([
    'prefix' => 'lv',
    ], function() {
    Route::get('/', 'PagesController@home')->name('pages.home');
    Route::get('nosotros', 'PagesController@about')->name('pages.about');
    Route::get('archivo', 'PagesController@archive')->name('pages.archive');
    Route::get('contacto', 'PagesController@contact')->name('pages.contact');
    Route::get('blog/{post}', 'PostsController@show')->name('posts.show');
    Route::get('categoria/{category}', 'CategoriesController@show')->name('categories.show');
    Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');
});


//Route::get('home', function() {
//    return view('admin.dashboard');
//})->middleware('auth');

Route::auth(['register' => true]);

Route::group([
    'prefix' => 'admin',
    'namespace' => 'admin',
    'middleware' => 'auth'
], function() {
    Route::get('/', 'AdminController@index')->name('dashboard');

    Route::resource('posts', 'PostsController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('users', 'UsersController', ['as' => 'admin']);
    Route::resource('roles', 'RolesController', ['except' => 'show', 'as' => 'admin']);
    Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'edit', 'update'], 'as' => 'admin']);

//    Route::get('posts', 'PostsController@index')->name('admin.posts.index');
//    Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
//    Route::post('posts', 'PostsController@store')->name('admin.posts.store');
//    Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
//    Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
//    Route::delete('posts/{post}', 'PostsController@destroy')->name('admin.posts.destroy');

    Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
    Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');

    Route::middleware('role:Admin')
        ->put('users/{user}/roles', 'UsersRolesController@update')
        ->name('admin.users.roles.update');

    Route::middleware('role:Admin')
        ->put('users/{user}/permissions', 'UsersPermissionsController@update')
        ->name('admin.users.permissions.update');
});

// Route::get('test', function() {
//     $palabra = 'miguel';
//     $data = [
//        'makehash' => Hash::make($palabra),
//        'makehas2' => Hash::make($palabra),
//        'bcrypt__' => bcrypt($palabra),
//        'bcrypt_2' => bcrypt($palabra),
//        'passwd' => $palabra,
//         'test' => '',
//     ];
//     return $data;
// });
// Route::get('posts', function(){
//     return App\Post::all();
// });
// Route::get('posts_prueba', function(){
//     return App\Post::findByUrl('mi-primer-post');
// });

// SPA Routes
Route::get('/{any?}', 'PagesController@spa')->name('pages-spa.home')->where('any', '.*');
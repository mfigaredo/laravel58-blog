<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', 'PagesController@home');
Route::get('blog/{post}', 'PostsController@show');
Route::get('categorias/{category}', 'CategoriesController@show');
Route::get('etiquetas/{tag}', 'TagsController@show');
Route::get('archivo', 'PagesController@archive');
Route::post('messages', function() {
    return response()->json([
        'estatus' => 'OK'
    ]);
});
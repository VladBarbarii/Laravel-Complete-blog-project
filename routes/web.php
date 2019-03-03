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

Route::get('/', 'PostController@index');
Route::resource('posts','PostController');
Route::resource('tags','TagController');
Route::resource('categories','CategoryController');
Route::get('category/{category}', 'CategoryController@show')->name('showcate');
Route::get('tag/{tag}', 'TagController@show')->name('showtag');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('test', function (){
//    return view('layouts.app');
//});
Route::get('/deleteTag', function () {
    $tags =\App\Tag::all();
    return view('pages.deleteTag', compact('tags'));
});

Route::get('/deleteCategory', function () {
    $categories =\App\Category::all();
    return view('pages.deleteCategory', compact('categories'));
});

Route::get('/myPosts', 'PostController@myPosts')->name('posts.myPosts');
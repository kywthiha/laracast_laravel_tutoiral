<?php
use Illuminate\Support\Facades\Auth;
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
    return view('posts.home');
});
Route::get('/about', function () {
    return view('posts.about');
});

Route::get('/articles','ArticleController@index')->name('articles.index');
Route::get('/articles/create','ArticleController@create')->name('articles.create');
Route::get('/articles/{article}','ArticleController@show')->name('articles.show');


Route::post('/articles','ArticleController@store')->name('articles.store');

Route::get('/articles/{article}/edit','ArticleController@edit')->name('articles.edit')->middleware('can:update,article');
Route::put('/articles/{article}','ArticleController@update')->name('articles.update')->middleware('can:update,article');

Route::delete('/articles/{article}','ArticleController@destroy')->name('articles.delete')->middleware('can:delete,article');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

Route::get('/users','UserController@index')->name('users.index');
Route::get('/users/user','ArticleController@create')->name('users.create');
Route::get('/users/{user}','ArticleController@show')->name('users.show');


Route::post('/users','ArticleController@store')->name('users.store');

Route::get('/users/{user}/edit','ArticleController@edit')->name('users.edit')->middleware('can:update,user');
Route::put('/users/{user}','ArticleController@update')->name('users.update')->middleware('can:update,user');

Route::delete('/users/{user}','ArticleController@destroy')->name('users.delete')->middleware('can:delete,user');


Route::get('/roles','RoleController@index')->name('roles.index');
Route::get('/roles/create','RoleController@create')->name('roles.create');
Route::get('/roles/{role}','RoleController@show')->name('roles.show');


Route::post('/roles','RoleController@store')->name('roles.store');

Route::get('/roles/{role}/edit','RoleController@edit')->name('roles.edit');
Route::put('/roles/{role}','RoleController@update')->name('roles.update');

Route::delete('/roles/{role}','RoleController@destroy')->name('roles.delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

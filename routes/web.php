<?php

use App\Article;
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
    return view('home');
});

Route::get('/articles/search','ArticleController@search')->name('articles.search');

Route::resource('/articles','ArticleController');

Route::prefix('/users')->middleware('auth')->group(function(){
    Route::get('/','UserController@index')->name('users.index');
    Route::get('/user','UserController@create')->name('users.create');
    Route::get('/{user}','UserController@show')->name('users.show')->middleware('can:view,user');
    Route::post('/users','UserController@store')->name('users.store');
    Route::get('/{user}/assign_role','UserController@editAssignRole')->name('users.assign_role')->middleware('can:update,user');
    Route::put('/assign/{user}','UserController@updateAssignRole')->name('users.update_assign_role')->middleware('can:update,user');
    Route::delete('/{user}','UserController@destroy')->name('users.delete');
});


Route::resource('/roles','RoleController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



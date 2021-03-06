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
    return view('home');
});

Route::get('/articles/search','ArticleController@search')->name('articles.search');

Route::resource('/articles','ArticleController');

Route::prefix('/users')->middleware('auth')->group(function(){
    Route::get('/','UserController@index')->name('users.index')->middleware('can:viewAny,App\User');
    Route::get('/{user}','UserController@show')->name('users.show')->middleware('can:view,user');
    Route::get('/{user}/assign_role','UserController@editAssignRole')->name('users.assign_role')->middleware('can:assignRole,user');
    Route::put('/assign/{user}','UserController@updateAssignRole')->name('users.update_assign_role')->middleware('can:assignRole,user');
    Route::delete('/{user}','UserController@destroy')->name('users.delete');
});

Route::prefix('/user')->middleware('auth')->group(function(){
    Route::get('/{user}/profile','UserController@profile')->name('user.profile')->middleware('can:changePassword,user');
    Route::get('/edit-password','UserController@editPassword')->name('user.edit_password');
    Route::put('/change-password', 'UserController@changePassword')->name('user.change_password');
    Route::patch('/upload-profile','UserController@storeProfileImage')->name('user.upload_profile');
});

Route::resource('/roles', 'RoleController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/article/{article}/comments', 'CommentController@index')->middleware('auth', 'can:viewAny,App\Article');
Route::post('/article/{article}/comments/{comment?}', 'CommentController@store')->middleware('auth', 'can:create,App\Article');
Route::put('/article/{article}/comments/{comment}', 'CommentController@update')->middleware('auth', 'can:update,comment');
Route::delete('/article/{article}/comments/{comment}', 'CommentController@destroy')->middleware('auth', 'can:delete,comment');

Route::post('images/upload', 'ImageUploadController@store')->name('images.upload')->middleware('auth');

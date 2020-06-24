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
Route::get('/about', function () {
    return view('posts.about');
});

Route::resource('/articles','ArticleController');
Route::get('/users','UserController@index')->name('users.index');
Route::get('/users/user','UserController@create')->name('users.create');
Route::get('/users/{user}','UserController@show')->name('users.show');


Route::post('/users','UserController@store')->name('users.store');

Route::get('/users/{user}/assign_role','UserController@editAssignRole')->name('users.assign_role');
Route::put('/users/assign/{user}','UserController@updateAssignRole')->name('users.update_assign_role');

Route::delete('/users/{user}','UserController@destroy')->name('users.delete');


Route::resource('/roles','RoleController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/hello/{locale?}',function ($locale ='en'){
    App::setLocale($locale);
   return view('welcome') ;
});

Route::get('/admin',function (){
    return view('admin.index');
});

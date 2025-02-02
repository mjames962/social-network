<?php

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

Auth::routes();

Route::get('/', function () {
    return redirect('/threads');
});

Route::get('threads', 'ThreadController@index')->name('threads.index');
Route::get('threads/create', 'ThreadController@create')->name('threads.create');
Route::post('threads', 'ThreadController@store')->name('threads.store');
Route::get('threads/{thread}', 'ThreadController@show')->name('threads.show');
Route::delete('threads/{thread}', 'ThreadController@destroy')->name('threads.destroy');
Route::get('/threads/{thread}/edit', 'ThreadController@edit')->name('threads.edit');
Route::post('/threads/{thread}/edit', 'ThreadController@update')->name('threads.update');

Route::post('threads/{thread}', 'CommentController@store')->name('comments.store');
Route::delete('comment/{comment}/edit', 'CommentController@destroy')->name('comments.destroy');
Route::get('/comment/{comment}/edit', 'CommentController@edit')->name('comments.edit');
Route::post('/comment/{comment}/edit', 'CommentController@update')->name('comments.update');

Route::get('/home', 'HomeController@index')->name('home');
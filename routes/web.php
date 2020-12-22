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

Route::get('/', function () {
    return view('welcome');
});

Route::get('threads', 'ThreadController@index')->name('threads.index');

Route::get('threads/create', 'ThreadController@create')->name('threads.create');

Route::post('threads', 'ThreadController@store')->name('threads.store');

Route::get('threads/{thread}', 'ThreadController@show')->name('threads.show');

Route::delete('threads/{thread}', 'ThreadController@destroy')->name('threads.destroy');

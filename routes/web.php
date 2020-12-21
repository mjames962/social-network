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

Route::any('thread', function(){
    return view('thread');
});

Route::get('threads', 'ThreadController@index')->name('threads.index');

Route::get('threads/{thread}', 'ThreadController@show')->name('threads.show');


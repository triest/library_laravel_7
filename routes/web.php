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
    return view('index');
})->name('main');

    Route::get('/authors', 'IndexController@authors')->name('authors');
    Route::post('/authors', 'IndexController@store_author')->name('store_author');

    Route::get('/books', 'IndexController@books')->name('books');
    Route::post('/books', 'IndexContreller@store_book')->name('store_book');

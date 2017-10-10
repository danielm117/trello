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
// Default route
Route::get('/', function () {
    return view('welcome');
});

// Init app 
Route::name('home')->get('/trello', 'StartController@index');

// List board
Route::name('boards')->get('/trello/boards', 'BoardController@index');
Route::get('/trello/board', 'BoardController@index');

// CRUD Operations
Route::name('card_delete')->get('/trello/board/card_delete/{id}', 'BoardController@delete');
Route::name('card_store')->post('/trello/board/card', 'BoardController@store');
Route::name('card_update')->post('/trello/board/card_update/{id}', 'BoardController@update');
Route::name('board')->get('/trello/board/{id}', 'BoardController@show');

//This route colaborate in send token to app
Route::get('/trello/token', 'BoardController@create');


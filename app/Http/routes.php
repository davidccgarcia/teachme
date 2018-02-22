<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', 'WelcomeController@index');

// Route::get('home', 'HomeController@index');

Route::get('/', [
    'uses' => 'TicketsController@latest', 
    'as' => 'tickets.latest'
]);

Route::get('popular', [
    'uses' => 'TicketsController@popular', 
    'as' => 'tickets.popular'
]);

Route::get('open', [
    'uses' => 'TicketsController@open', 
    'as' => 'tickets.open'
]);

Route::get('closed', [
    'uses' => 'TicketsController@closed', 
    'as' => 'tickets.closed'
]);

Route::get('details/{id}', [
    'uses' => 'TicketsController@details', 
    'as' => 'tickets.details'
]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('request', [
        'uses' => 'TicketsController@request', 
        'as' => 'tickets.request' 
    ]);

    Route::post('store', [
        'uses' => 'TicketsController@store', 
        'as' => 'tickets.store' 
    ]);

    Route::post('vote/{ticket}/', [
        'uses' => 'VotesController@submit', 
        'as' => 'tickets.submit'
    ]);

    Route::post('unvote/{ticket}/', [
        'uses' => 'VotesController@destroy', 
        'as' => 'tickets.destroy'
    ]);

    Route::post('comment/{ticket}', [
        'uses' => 'CommentsController@store', 
        'as' => 'comments.store'
    ]);
});

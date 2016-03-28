<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//put everything under the middleware group

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => 'web'], function () {
    //standard auth stuff
    Route::auth();
    Route::get('/login', [
        'as' => 'login',
        'uses' => 'Auth\AuthController@getLogin'
    ]);

    //bookmarks-specific routes & methods
    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'BookmarksController@index'
    ]);
    Route::post('/dashboard/add', [
        'as' => 'add',
        'uses' => 'BookmarksController@addBookmark'
    ]);
     Route::post('/dashboard/update', [
        'as' => 'update',
        'uses' => 'BookmarksController@updateBookmark'
    ]);
    Route::post('/dashboard/delete', [
        'as' => 'delete',
        'uses' => 'BookmarksController@deleteBookmark'
    ]);
    Route::get('/', [
        'as' => 'homepage',
        'uses' => function () {
            return view('homepage');
        }
    ]);
});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [
        'uses' => 'UserController@getIndex',
        'as'   => 'index'
    ]);

    Route::post('/signin', [
        'uses' => 'UserController@postSignIn',
        'as'   => 'signin'
    ]);

    Route::post('/signup', [
        'uses' => 'UserController@postSignUp',
        'as'   => 'signup'
    ]);

    Route::get('/dashboard', [
        'uses'       => 'TaskController@getIndex',
        'as'         => 'dashboard',
        'middleware' => 'auth'
    ]);

    Route::get('/dashboard', [
        'uses'       => 'TaskController@getTasks',
        'as'         => 'get.tasks',
    ]);

    Route::post('/dashboard', [
        'uses' => 'TaskController@postNewTask',
        'as'   => 'add.task'
    ]);

    Route::post('/edit', [
        'uses' => 'TaskController@postEditTask',
        'as'   => 'edit',
    ]);

    Route::get('/delete/{task_id}', [
        'uses'       => 'TaskController@getTaskDelete',
        'as'         => 'task.delete',
        'middleware' => 'auth'

    ]);

    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as'   => 'logout'
    ]);

});





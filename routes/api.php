<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', ['as' => 'login', 'uses' => 'Api\AuthController@login']);
    Route::post('register', ['as' => 'register', 'uses' => 'Api\AuthController@register']);
});

Route::group(['prefix' => 'posts'], function() {
    Route::get('index', 'Api\PostsController@index');
    Route::post('store', 'Api\PostsController@store');
    Route::get('approve/{id}', 'Api\PostsController@approve');
    Route::get('disapprove/{id}', 'Api\PostsController@disapprove');
    Route::post('destroy/{id}', 'Api\PostsController@destroy');
});
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
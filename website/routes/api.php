<?php

use Illuminate\Http\Request;

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

Route::group([
    'middleware' => 'api',
    'namespace' => 'Auth',
    'prefix' => 'auth',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');

    Route::group([
        'middleware' => ['jwt.refresh'],
    ], function () {
        Route::post('refresh', 'AuthController@refresh');

    });
});

Route::group([
    'middleware' => ['jwt.renew'],
], function () {
    Route::get('vue', 'HomeController@vue');
});

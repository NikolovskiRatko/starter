<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| This file contains the api routes for the Order module
|
|
*/

// Non auth routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'guest/order',
], function () {
});


// Authorized routes
Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'order',
], function () {
    Route::get('save', 'Controllers\OrderController@save');
    Route::post('draw', 'Controllers\OrderController@drawOrder');
    Route::get('{id}/get', 'Controllers\OrderController@getOrder');
    Route::get('{id}/delete', 'Controllers\OrderController@deleteOrder');
    Route::post('new', 'Controllers\OrderController@storeOrder')/*->middleware('permission:user_write', 'role:administrator')*/;
    Route::post('admin/new', 'Controllers\OrderController@createOrder')/*->middleware('permission:user_write', 'role:administrator')*/;
    Route::post('{id}/edit', 'Controllers\OrderController@updateOrder')/*->middleware('permission:user_write', 'role:administrator')*/;
    Route::post('export', 'Controllers\OrderController@exportOrders');
});

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| This file contains the api routes for the Product module
|
|
*/

// Non auth routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'guest/product',
], function () {
    Route::post('save-offer', 'Controllers\ProductController@saveOffer');
    Route::post('get-offers', 'Controllers\ProductController@getOffers');
    Route::post('recalculate-offers', 'Controllers\ProductController@recalculateOffers');
    Route::post('test-offers', 'Controllers\ProductController@recalculateOffersForTesting');
//    Route::post('get-packaging', 'Controllers\ProductController@calculatePackaging');

    Route::group([
        'middleware' => ['owner:App\Applications\Product\Model\Product,id'],
    ], function () {
        Route::get('{id}/delete', 'Controllers\ProductController@deleteProduct');
    });
});


// Authorized routes
Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'product',
], function () {
    Route::get('save', 'Controllers\ProductController@save');
    Route::post('draw', 'Controllers\ProductController@drawProduct');
    Route::get('orders', 'Controllers\ProductController@getOrdersForUser');
    Route::get('offers', 'Controllers\ProductController@getOffersForUser');
    Route::get('offer/{id}/get', 'Controllers\ProductController@getOffer');
    Route::get('{id}/get', 'Controllers\ProductController@getProduct');
    Route::get('{id}/delete', 'Controllers\ProductController@deleteProduct');
    Route::post('new', 'Controllers\ProductController@storeProduct')->middleware('permission:user_write', 'role:administrator');
    Route::post('{id}/edit', 'Controllers\ProductController@updateProduct')->middleware('permission:user_write', 'role:administrator');
});

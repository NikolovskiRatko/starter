<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| This file contains the api routes for the Homepage module
|
|
*/
// Non auth routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'guest/homepage/slider',
], function () {
    Route::get('fetch', 'HomepageController@getTopSliderItems');
});

// Authorized routes
//Route::group([
//    'middleware' => ['api','jwt.renew'],
//    'prefix' => 'homepage/slider',
//], function () {
//    Route::get('all', 'Controllers\SliderController@all');
//    Route::get('{id}/get', 'Controllers\SliderController@get');
//    Route::get('{id}/access', 'Controllers\SliderController@access');
//    Route::get('{id}/delete', 'Controllers\SliderController@delete');
//    Route::get('{id}/restore', 'Controllers\SliderController@restore');
//    Route::post('{id}/edit', 'Controllers\SliderController@editSlider');
//    Route::post('new', 'Controllers\SliderController@new');
//    Route::post('draw', 'Controllers\SliderController@draw');
//    Route::post('archive/draw', 'Controllers\SliderController@drawArchive');
//    Route::get('remove/{type}/{id}', 'Controllers\SliderController@removeFile');
//    Route::get('relations', 'Controllers\SliderController@getRelationsForDropdown');
//    Route::get('{id}/up', 'Controllers\SliderController@upOrder');
//    Route::get('{id}/down', 'Controllers\SliderController@downOrder');
//});

// Authorized routes
Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'slides',
], function () {
    Route::post('draw', 'HomepageController@drawSlides');
    Route::get('{id}/get', 'HomepageController@getSlide');
    Route::get('{id}/delete', 'HomepageController@deleteSlide');
    Route::post('new', 'HomepageController@storeSlide')->middleware('permission:user_write', 'role:administrator');
    Route::post('{id}/edit', 'HomepageController@updateSlide')->middleware('permission:user_write', 'role:administrator');
});

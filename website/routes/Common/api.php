<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| This file contains the api routes for the Common module
|
|
*/


// Non auth routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'guest/common',
], function () {
    Route::get('get-handle-types', 'Controllers\TaxonomiesController@getHandleTypes');
    Route::get('get-paper-types', 'Controllers\TaxonomiesController@getPaperTypes');
    Route::get('get-lamination-types', 'Controllers\TaxonomiesController@getLaminationTypes');
    Route::get('get-color-types', 'Controllers\TaxonomiesController@getColorTypes');
    Route::get('get-handle-color-types', 'Controllers\TaxonomiesController@getHandleColorTypes');
    Route::get('get-ratios', 'Controllers\TaxonomiesController@getRatios');
    Route::get('get-combinations', 'Controllers\TaxonomiesController@getCombinations');
    Route::get('get-countries', 'Controllers\TaxonomiesController@getCountries');
    Route::post('contact', 'Controllers\DashboardController@contact');
});

// Authorized routes
Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'common',
], function () {
    Route::get('dashboard/get', 'Controllers\DashboardController@getDashboardInformation');

    Route::get('combinations/getall', 'Controllers\CombinationController@getCombinationsAdmin');
    Route::post('combinations/order', 'Controllers\CombinationController@orderCombinations');
    Route::post('combinations/new', 'Controllers\CombinationController@newCombination');
    Route::get('combinations/delete/{id}', 'Controllers\CombinationController@deleteCombination');
    Route::get('combinations/restore/{id}', 'Controllers\CombinationController@restoreCombination');
    Route::post('combinations/edit/{id}', 'Controllers\CombinationController@editCombination');

    Route::get('formats/getall', 'Controllers\TaxonomiesController@getFormats');
    Route::get('ratios/getall', 'Controllers\TaxonomiesController@getRatios');
    Route::get('parameters/getall', 'Controllers\TaxonomiesController@getParameters');
    Route::get('handles/getall', 'Controllers\TaxonomiesController@getHandles');
    Route::get('laminations/getall', 'Controllers\TaxonomiesController@getLaminations');
    Route::get('papers/getall', 'Controllers\TaxonomiesController@getPapers');
    Route::post('shipping/draw', 'Controllers\TaxonomiesController@drawShipping');
    Route::get('shipping/get', 'Controllers\TaxonomiesController@getShippingParametars');
    Route::post('shipping/edit', 'Controllers\TaxonomiesController@editShippingParametars');
});

Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'common',
], function () {
    Route::get('parameters/getall', 'Controllers\ParameterController@getParametersAdmin');
    Route::post('parameters/order', 'Controllers\ParameterController@orderParameters');
    Route::post('parameters/new', 'Controllers\ParameterController@newParameter');
    Route::get('parameters/delete/{id}', 'Controllers\ParameterController@deleteParameter');
    Route::get('parameters/restore/{id}', 'Controllers\ParameterController@restoreParameter');
    Route::post('parameters/edit/{id}', 'Controllers\ParameterController@editParameter');
});

Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'common',
], function () {
    Route::get('formats/getall', 'Controllers\FormatController@getFormatsAdmin');
    Route::post('formats/order', 'Controllers\FormatController@orderFormats');
    Route::post('formats/new', 'Controllers\FormatController@newFormat');
    Route::get('formats/delete/{id}', 'Controllers\FormatController@deleteFormat');
    Route::get('formats/restore/{id}', 'Controllers\FormatController@restoreFormat');
    Route::post('formats/edit/{id}', 'Controllers\FormatController@editFormat');
});
Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'common',
], function () {
    Route::get('cliches/getall', 'Controllers\ClicheController@getClichesAdmin');
    Route::post('cliches/order', 'Controllers\ClicheController@orderCliches');
    Route::post('cliches/new', 'Controllers\ClicheController@newCliche');
    Route::get('cliches/delete/{id}', 'Controllers\ClicheController@deleteCliche');
    Route::get('cliches/restore/{id}', 'Controllers\ClicheController@restoreCliche');
    Route::post('cliches/edit/{id}', 'Controllers\ClicheController@editCliche');
});
Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'common',
], function () {
    Route::get('colors/getall', 'Controllers\ColorController@getColorsAdmin');
    Route::post('colors/order', 'Controllers\ColorController@orderColors');
    Route::post('colors/new', 'Controllers\ColorController@newColor');
    Route::get('colors/delete/{id}', 'Controllers\ColorController@deleteColor');
    Route::get('colors/restore/{id}', 'Controllers\ColorController@restoreColor');
    Route::post('colors/edit/{id}', 'Controllers\ColorController@editColor');
});
Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'common',
], function () {
    Route::get('handles/getall', 'Controllers\HandleController@getHandlesAdmin');
    Route::post('handles/order', 'Controllers\HandleController@orderHandles');
    Route::post('handles/new', 'Controllers\HandleController@newHandle');
    Route::get('handles/delete/{id}', 'Controllers\HandleController@deleteHandle');
    Route::get('handles/restore/{id}', 'Controllers\HandleController@restoreHandle');
    Route::post('handles/edit/{id}', 'Controllers\HandleController@editHandle');
});
Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'common',
], function () {
    Route::get('laminations/getall', 'Controllers\LaminationController@getLaminationsAdmin');
    Route::post('laminations/order', 'Controllers\LaminationController@orderLaminations');
    Route::post('laminations/new', 'Controllers\LaminationController@newLamination');
    Route::get('laminations/delete/{id}', 'Controllers\LaminationController@deleteLamination');
    Route::get('laminations/restore/{id}', 'Controllers\LaminationController@restoreLamination');
    Route::post('laminations/edit/{id}', 'Controllers\LaminationController@editLamination');
});
Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'common',
], function () {
    Route::get('papers/getall', 'Controllers\PaperController@getPapersAdmin');
    Route::post('papers/order', 'Controllers\PaperController@orderPapers');
    Route::post('papers/new', 'Controllers\PaperController@newPaper');
    Route::get('papers/delete/{id}', 'Controllers\PaperController@deletePaper');
    Route::get('papers/restore/{id}', 'Controllers\PaperController@restorePaper');
    Route::post('papers/edit/{id}', 'Controllers\PaperController@editPaper');
});

Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'common',
], function () {
    Route::get('packageweights/getall', 'Controllers\PackageWeightController@getPackageWeightsAdmin');
    Route::post('packageweights/order', 'Controllers\PackageWeightController@orderPackageWeights');
    Route::post('packageweights/new', 'Controllers\PackageWeightController@newPackageWeight');
    Route::get('packageweights/delete/{id}', 'Controllers\PackageWeightController@deletePackageWeight');
    Route::get('packageweights/restore/{id}', 'Controllers\PackageWeightController@restorePackageWeight');
    Route::post('packageweights/edit/{id}', 'Controllers\PackageWeightController@editPackageWeight');
});

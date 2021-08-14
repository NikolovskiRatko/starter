<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => 'guest',
], function () {
    Route::post('password/email', '\App\Applications\User\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', '\App\Applications\User\Auth\ResetPasswordController@reset');
});

// It's necessary for the reset password e-mail
Route::get('password/reset/{token}', 'HomeController@index')->name('password.reset');

Route::get('/login', 'HomeController@indexAdmin')->where('any', '.*');
Route::get('/admin', 'HomeController@indexAdmin')->where('any', '.*');
Route::get('/admin/{any}', 'HomeController@indexAdmin')->where('any', '.*');
Route::get('/{any}', 'HomeController@index')->where('any', '.*');
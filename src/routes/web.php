<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the AgeGateServiceProvider.
|
*/

// without 'web' middleware, csrf token is not generated
Route::namespace('Kubis\AgeGate\Controllers')->middleware('web')->group(function () {
    Route::get(config('agegate.page_url', '/age-gate'), 'MainController@get')->name('age-gate.redirect');
    Route::post(config('agegate.page_url', '/age-gate'), 'MainController@post')->name('age-gate.post');
});
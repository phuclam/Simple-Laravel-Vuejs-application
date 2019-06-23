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

/**
 * ---------------------------
 * Frontend Route
 * ---------------------------
 */
Route::group(['prefix' => 'frontend'], function () {
    Route::post('login', 'Frontend\AuthController@login');
    Route::middleware('auth:api')->group(function () {
        Route::get('logout', 'Frontend\AuthController@logout');
        Route::get('user/profile', 'Frontend\UserController@profile');
    });
});
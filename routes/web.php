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

/**
 * ---------------------------
 * Frontend Route
 * ---------------------------
 */
Route::get('/{any?}', function (){
    phpinfo();
    return view('frontend.master');
})->where('any', '^(?!admin)(?!api)[\/\w]*');

/**
 * ---------------------------
 * Backend Route
 * ---------------------------
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Backend\AuthController@showLoginForm')->name('login');
    Route::post('login', 'Backend\AuthController@login');
    Route::middleware('auth:admin')->group(function () {
        Route::get('logout', 'Backend\AuthController@logout')->name('logout');
        Route::group(['prefix' => 'api'], function () {
            Route::resource('rooms', 'Backend\RoomController');
            Route::resource('room-types', 'Backend\RoomTypeController');
            Route::resource('room-capacities', 'Backend\RoomCapacityController');
        });
        Route::get('/{any?}', function (){
            return view('backend.master');
        })->where('any', '^(?!api)[\/\w]*');
    });
});
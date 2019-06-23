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
Route::get('/', function () {
    return view('frontend.master');
});

Route::get('/{any?}', function (){
    return view('backend.master');
})->where('any', '^(?!api|admin\/)[\/\w\.-]*');

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
        Route::get('/', function () {
            return view('backend.master');
        });
        Route::get('/{any?}', function (){
            return view('backend.master');
        })->where('any', '^(?!api\/)[\/\w\.-]*');

        Route::group(['prefix' => 'api'], function () {
            Route::resource('rooms', 'Backend\RoomController');
        });
    });
});
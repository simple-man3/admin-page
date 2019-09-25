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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('platform-connect', 'Api\\PlatformController@connect');

Route::middleware('platform.key')->group(function () {
    Route::get('status', function () {
        return collect([
            'status' => 'active'
        ])->toJson();
    });

    Route::name('plugins.')->prefix('plugins')->group(function () {
        Route::get('list', 'Api\\PlatformController@pluginsList')->name('list');
    });
});

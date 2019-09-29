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
        Route::post('find', 'Api\\PlatformController@pluginFind')->name('find');
        Route::post('install', 'Api\\PlatformController@pluginInstall')->name('install');
        Route::post('update', 'Api\\PlatformController@pluginUpdate')->name('update');
        Route::post('delete', 'Api\\PlatformController@pluginDelete')->name('delete');
    });
});

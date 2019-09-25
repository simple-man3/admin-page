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

// Главная страница CMS
Route::get('/', 'PostController@index');

// Маршруты авторизации / регистрации
Auth::routes();

// CRUD маршруты для статей (постов)
Route::resource('/post', 'PostController')->middleware(['auth']);

// TODO
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function () {
    // TODO remove this route or add middleware
    abort(401, 'Доступно только разработчикам');

    $path = app_path('Plugins');
    $files = (new \App\Providers\PluginServiceProvider(null))->getPluginInfoPaths($path);
    $scheme = new \App\Library\PluginSystem\PluginInfoScheme();
    $scheme->load($files[0]);
//    dd($scheme);

//    dd(\App\Library\PluginSystem\PluginSystemManager::GetPluginByPackage('ExampleOne'));
//    dd(\App\Library\PluginSystem\PluginSystemManager::GetPluginsByVendor('PressStartOfficial'));
    dd(\App\Library\PluginSystem\PluginSystemManager::GetPlugins());
});

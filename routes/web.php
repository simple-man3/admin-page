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
//    dd((new \App\Library\ReflectionHelper\ReflectionHelper())->getClassFullNameFromFile(app_path('Plugins/ExampleOne/ExampleSidebarWidget.php')));
//    dd((new ReflectionClass((new \App\Library\ReflectionHelper\ReflectionHelper())->getClassObjectFromFile(app_path('Plugins/ExampleOne/ExampleSidebarWidget.php'))))->getInterfaces());
//    dd((new ReflectionClass((new \App\Library\ReflectionHelper\ReflectionHelper())->getClassObjectFromFile(app_path('Plugins/ExampleOne/ExampleSidebarWidget.php'))))->getMethods());

//    dd((new \App\Library\PluginManagers\SidebarWidget\SidebarWidgetPluginManager())->plugins);
//    dd((new \App\Library\PluginManagers\SidebarWidget\SidebarWidgetPluginManager())->render());

    $path = app_path('Plugins');
    $files = (new \App\Providers\PluginServiceProvider(null))->rglob($path . '/*.php');
//    dd((new ReflectionClass((new \App\Library\ReflectionHelper\ReflectionHelper())->getClassObjectFromFile($files[0]))));
//    dd((new ReflectionClass((new \App\Library\ReflectionHelper\ReflectionHelper())->getClassObjectFromFile($files[0])))->getParentClass()->getName());
//    dd((new ReflectionClass((new \App\Library\ReflectionHelper\ReflectionHelper())->getClassFullNameFromFile($files[0])))->getParentClass()->getName());

//    dd((new \App\Providers\PluginServiceProvider(null))->rglob($path . '/*.php'));
//    dd((new \App\Providers\PluginServiceProvider(null))->rsearch($path, ));
//    dd((new \App\Providers\PluginServiceProvider(null))->getDirContents($path));

//    (new \App\Providers\PluginServiceProvider(null))->register();
//    dd(\App\Library\PluginManagers\SidebarWidget\SidebarWidgetPluginManager::$plugins[0]->GetRenderedWidget());
//    dd((new \App\Library\PluginManagers\SidebarWidget\SidebarWidgetPluginManager)->render());

//    dd(\App\Library\PluginSystem\PluginSystemManager::GetPluginByClassName(\App\Plugins\ExampleOne\ExampleSidebarWidget::class));
    dd(\App\Library\PluginSystem\PluginSystemManager::GetPlugins());
});

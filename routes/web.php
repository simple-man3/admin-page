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

//region system_route

// Маршруты авторизации / регистрации
Auth::routes();

// CRUD маршруты для статей (постов)
Route::resource('/post', 'PostController');

// TODO
Route::get('/home', 'HomeController@index')->name('home');

//Админка
Route::group(['prefix'=>'admin','middleware'=>'auth_admin_page','namespace'=>'Admin'],function (){

    //Пользователь хочет авторизироваться
    Route::get('/',['uses'=>'AdminController@index']);

    //Главное
    Route::get('/main',['uses'=>'AdminController@show_main','as'=>'admin_main']);

    //region Контент
    Route::group(['prefix'=>'content'],function (){

        //Отображает список категорий
        Route::get('/list_categories',['uses'=>'AdminController@displayListCategories','as'=>'list_categories']);

        //Отображает список контента в зависимости от категории
        Route::get('/list_elements/{id}',['uses'=>'AdminController@displayAllContent','as'=>'list_content']);

        //Отображение формы добавления контента
        Route::get('/display_from/{id}',['uses'=>'AdminController@displayFormContent','as'=>'from_add_content']);

        //Добавление контента по нажатию кнопки
        Route::post('/display_from/add/{id}',['uses'=>'AdminController@addContent','as'=>'add_content']);

        //Отображение контента детально
        Route::get('/detail_content/{idCategory}/{idContent}',['uses'=>'AdminController@detailContent','as'=>'detail_content']);

        //Сохранение изменения контента в детальной странице
        Route::post('/detail_content/update/{idCategory}/{idContent}',['uses'=>'AdminController@updateContent','as'=>'update_detail']);

        //Добавление категории
        Route::post('/add_content/add_category',['uses'=>'AdminController@addCategory','middleware'=>'validationMiddleware','as'=>'addCategory']);

        //Выболнить действия с контентом
        Route::post('/list_elements/action/{id}',['uses'=>'AdminController@actionListElements','as'=>'actionListElements']);

        //Выболнить действия с категориями
        Route::post('/list_categories/action/',['uses'=>'AdminController@actionListCategories','as'=>'actionListCategories']);
    });
    //endregion

    //Учетка
    Route::get('/account',['uses'=>'AdminController@show_account','as'=>'admin_account']);
    //Настройки
    Route::get('/setting',['uses'=>'AdminController@show_setting','as'=>'admin_setting']);

    Route::post('/setting/theme/change', 'AdminController@change_theme')->name('admin.settings.change_theme');
});

Route::get('/test', function () {
    // TODO remove this route or add middleware
    abort(401, 'Доступно только разработчикам');

    \App\Library\PluginSystem\PlatformManager::installPlugin('PressStartOfficial', 'ExampleOne', '0.1.1');
    dd('done');
    dd(\App\Library\PluginSystem\PluginSystemManager::GetPlugins());
});

//endregion

// Главная страница CMS
Route::get('/', ['uses'=>'UserController\PostController@index']);

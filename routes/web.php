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
Route::get('/', 'PostController@index')->name('home_page');

// Маршруты авторизации / регистрации
Auth::routes();

// CRUD маршруты для статей (постов)
Route::resource('/post', 'PostController')->middleware(['auth']);

// TODO
Route::get('/home', 'HomeController@index')->name('home');

//Админка
Route::group(['prefix'=>'admin','middleware'=>'auth_admin_page'],function (){
    //Главное
    Route::get('/main',['uses'=>'Admin\AdminController@show_main','as'=>'admin_main']);
    //Контент
    Route::get('/content',['uses'=>'Admin\AdminController@show_content','as'=>'admin_content']);
    //Учетка
    Route::get('/account',['uses'=>'Admin\AdminController@show_account','as'=>'admin_account']);
    //Настройки
    Route::get('/setting',['uses'=>'Admin\AdminController@show_setting','as'=>'admin_setting']);
});

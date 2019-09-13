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

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Статьи...
Route::get('/', 'IndexController@index');
Route::get('article/technology', 'IndexController@technology');
Route::get('account/makecaptcha', 'IndexController@makecaptcha');
Route::get('article/contacts', 'IndexController@contacts');
Route::post('article/contacts', 'IndexController@addcontacts')->name('addcontacts');

// Новости... 
Route::get('news/', 'NewsController@index')->name('viewall');
Route::get('news/add', 'NewsController@add');
Route::post('news/add', 'NewsController@addnews')->name('addnews');
Route::get('news/view/{id}', 'NewsController@view')->name('view');
Route::get('news/edit/{id}', 'NewsController@edit');
Route::post('news/edit/{id}', 'NewsController@editnews')->name('edit');

// Маршруты аутентификации...
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', 'Auth\LoginController@logout');

// Маршруты регистрации...
Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('auth/register', 'Auth\RegisterController@register');

Event::listen('404', function () {
    return Response::error('404');
});
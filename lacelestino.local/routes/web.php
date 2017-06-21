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

Route::get( '/', [ 'uses'=>'IndexController@index', 'as'=>'home' ] );

Route::match(
    ['get','post'],
    '/contacts',
    ['uses'=>'ContactController@index','as'=>'contacts']
);

Route::get( '/about', [ 'uses'=>'AboutController@index', 'as'=>'about' ] );

Route::resource('article', 'ArticleController', [
    'only' => [ 'index', 'show']
]);
Route::get(
    'article/category/{category?}',
    [ 'uses'=>'ArticleController@index', 'as'=>'articleCategory' ]
)->where('category', '[\w-]+');

Route::resource('comment','CommentController',['only'=>['store']]);

Route::resource('portfolio', 'PortfolioController', [
    'only' => [ 'index', 'show']
]);


// php artisan make:auth
Route::get( 'login', [ 'uses'=>'Auth\LoginController@showLoginForm', 'as'=>'login' ] );
Route::post( 'login', [ 'uses'=>'Auth\LoginController@login' ] );
Route::get( 'logout', [ 'uses'=>'Auth\LoginController@logout', 'as'=>'logout' ] );

//admin
Route::group(['prefix' => 'admin','middleware'=> 'auth'],function() {

    Route::get('/', ['uses' => 'Admin\IndexController@index','as' => 'adminIndex']);
    
    Route::resource('/articles','Admin\ArticleController');
    
    Route::resource('/categories','Admin\CategoryController');
    
    Route::resource('/users','Admin\UserController');
    
    Route::resource('/permissions','Admin\PermissionController');

    Route::resource('/portfolios','Admin\PortfolioController');

});
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

Route::resource('product', 'ProductController', [
    'only' => [ 'show' ]
]);

Route::get(
    'category/{category}',
    [ 'uses'=>'CategoryController@index', 'as'=>'category' ]
)->where('category', '[\d]+');
Route::get('/category/pager', ['uses'=>'CategoryController@pager','as'=>'pager'] );
Route::get('/category/search', ['uses'=>'CategoryController@search','as'=>'search'] );

Route::resource('order', 'OrderController', [
    'only' => [ 'index', 'store']
]);

Route::get('/card/add', ['uses'=>'CardController@add','as'=>'addToCard'] );
Route::get('/card/delete', ['uses'=>'CardController@deleteItem','as'=>'deleteItem'] );

Route::match(
    ['get','post'],  '/contacts', ['uses'=>'ContactController@index','as'=>'contacts']
);

Route::get( 'login', [ 'uses'=>'Auth\LoginController@showLoginForm', 'as'=>'login' ] );
Route::post( 'login', [ 'uses'=>'Auth\LoginController@login' ] );
Route::get( 'logout', [ 'uses'=>'Auth\LoginController@logout', 'as'=>'logout' ] );

//admin
Route::group(['prefix' => 'admin','middleware'=> 'auth'],function() {

    Route::get('/', ['uses' => 'Admin\IndexController@index','as' => 'adminIndex']);
    
    Route::resource('/orders','Admin\OrderController');
    
    Route::resource('/categories','Admin\CategoryController');
    
    Route::resource('/products','Admin\ProductController');
    
    Route::post('/products/loader', ['uses'=>'Admin\ProductController@loader','as'=>'loader'] );
    
    Route::post('/products/delfile', ['uses'=>'Admin\ProductController@delfile','as'=>'delfile'] );
    
    Route::match(
        ['get','post'],  '/users', ['uses'=>'Admin\UserController@index', 'as'=>'editUser']
    );

});
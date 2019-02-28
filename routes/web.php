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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'app', 'as' => 'app.'], function () {
    Route::group(['namespace' => 'App'], function(){
        Route::group(['middleware' => ['auth:app_web', 'tenant', 'bindings']], function () {
            Route::get('dashboard', function () {
                return view('app.dashboard');
            });
            Route::resource('categories', 'CategoryController');
            Route::resource('products', 'ProductController');
        });
    });
    Auth::routes(['register' => false]); //app.login
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['namespace' => 'Admin'], function(){
        Route::group(['middleware' => ['auth:admin_web', 'bindings']], function () {
            Route::get('dashboard', function () {
                return view('admin.dashboard');
            });
        });
    });
    Auth::routes(['register' => false]); //admin/login admin.login
});

Route::get('/home', 'HomeController@index')->name('home');

//Classe::metodo1()
//Facade - Design Pattern
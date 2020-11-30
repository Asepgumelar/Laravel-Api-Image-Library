<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'image', 'as' => 'image.'], function () {
        Route::get('/', 'ImageController@index')->name('index');
        Route::get('/create', 'ImageController@create')->name('create');
        Route::post('/store-single', 'ImageController@storeSingle')->name('storeSingle');
        Route::post('/store-multiple', 'ImageController@storeMultiple')->name('storeMultiple');
        Route::get('/show/{id}', 'ImageController@show')->name('show');
    });

    Route::group(['prefix' => 'article', 'as' => 'article.'], function () {
        Route::get('/', 'ArticleController@index')->name('index');
        Route::get('/create', 'ArticleController@create')->name('create');
        Route::post('/store', 'ArticleController@store')->name('store');
    });
});

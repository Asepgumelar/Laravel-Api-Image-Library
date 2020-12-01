<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1/image', 'as' => 'api::image.', 'namespace' => 'Api\V1'], function () {
    Route::get('/', 'ImageController@index')->name('index');
    Route::post('/store', 'ImageController@store')->name('store');
});

Route::group(['prefix' => 'v1/article', 'as' => 'api::article.', 'namespace' => 'Api\V1'], function () {
    Route::post('/store', 'ArticleController@store')->name('store');
});

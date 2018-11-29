<?php

use Illuminate\Http\Request;

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
Route::group(['prefix' => 'auth'],function() { //前綴auth  路由經過中介層auth->api->guard->driver->jwt 所以要有token才能用以下的功能
    Route::get('/', 'AuthController@me');  //登入後去找 function me
    Route::post('login', 'AuthController@login'); //登入驗證
    Route::post('logout', 'AuthController@logout'); //登出
});

Route::group(['prefix' => 'post'],function() { //前綴post 路由經過中介層auth->api->guard->driver->jwt 所以要有token才能用以下的功能
    Route::get('index', 'PostController@index'); //顯示所有文章
    Route::get('show', 'PostController@show'); //顯示單筆文章
    Route::post('store', 'PostController@store'); //新增文章
    Route::put('updata/{id}', 'PostController@update'); //更新文章
    Route::delete('delete/{id}', 'PostController@destroy'); //刪除文章
});

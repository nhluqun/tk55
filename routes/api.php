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
//测试路由
Route::group(['namespace' => 'Api'], function () {
    Route::post('/login', 'UserController@login');
});
Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function() {
    Route::get('/userDetails', 'UserController@userDetails');
});
//系统自带路由
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//自已写的
Route::middleware('auth:api')->get('/index','Api\IndexController@index');
//Route::resource('/posts', 'Api\PostController');
Route::get('/posts', 'Api\PostController@apiAll');
Route::get('/posts/{id}', 'Api\PostController@apiFindPostById');
Route::post('/posts', 'Api\PostController@apiCreatePost');
Route::put('/posts/{id}', 'Api\PostController@apiUpdatePostById');
Route::delete('/posts/{id}', 'Api\PostController@apiDeletePostById');

Route::post('/dilixzts', 'DilixztController@apiCreateDilixzt');

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
Route::get('/setRoles', 'Api\UserController@setRoles');
Route::post('/Aregister', 'Api\UserController@Aregister');
Route::post('/upfile', 'fileUpload@upfile');
Route::get('/getKeshis', 'Api\KeshiController@getKeshis');
Route::get('/ppttest', 'Api\pptController@test');
Route::get('/dilixzts/fk', 'Api\DilixztController@fk');
Route::post('/dilixzts/search', 'Api\DilixztController@search');
Route::post('/dilixzts/searchOne', 'Api\DilixztController@searchOne');
//Route::get('/dilixzts/del/{id}', 'Api\DilixztController@destroy');
Route::resource('/dilixzts','Api\DilixztController');
//Route::post('/register', 'Auth\RegisterController@register');
//想利用现成的来注册，但是不成功。//能够注册成功，但是重定向/home
//Route::get('/queryUserByName', 'Api\UserController@queryUserByName');

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

//Route::post('/dilixzts', 'DilixztController@apiCreateDilixzt');

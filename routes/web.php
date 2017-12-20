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
    return view('index0');
});
Route::get('/clients',function(){
  return view('clients');
});
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/index','Api\IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/code', 'ApiController@sendVerifyCode');
Route::post('/bar', function()
{
return 'Hello World';
});

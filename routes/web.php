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
Route::any('/test/hello','Test\TestController@hello');
Route::any('/test/adduser','Test\TestController@adduser');

Route::get('/weixin','Weixin\WeixinController@weixin');
Route::post('/weixin','Weixin\WeixinController@receiv');
Route::get('/weixin/media','Weixin\WeixinController@getmedia');
Route::get('/weixin/info','Weixin\WeixinController@info');
Route::get('/token','Weixin\WeixinController@flushAccessToken');


Route::get('/weixin/menu','Weixin\WeixinController@createmenu');

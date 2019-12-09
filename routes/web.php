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
Route::any('/weixin','Weixin\WeixinController@weixin');
Route::post('/wx','Weixin\WeixinController@receiv');

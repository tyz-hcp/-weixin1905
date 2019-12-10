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

Route::get('/info',function(){
	phpinfo();
});
Route::get('/test/hello','Test\TestController@hello');
Route::get('/test/adduser','User\LoginController@adduser');


//微信开发


Router::get('/wx','weixi\Wxcontroller@wechat');
Router::post('/wx','weixi\Wxcontroller@receiv');        //接送微信的推送事件
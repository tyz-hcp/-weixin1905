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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','Index\IndexController@Index');  //网站首页
Route::get('/phpinfo',function(){
    phpinfo();
});  //网站首页



Route::any('/test/hello','Test\TestController@hello');
Route::any('/test/adduser','Test\TestController@adduser');

Route::get('/wx','Weixin\WeixinController@wechat');
Route::post('/wx','Weixin\WeixinController@receiv');
Route::get('/wx/media','Weixin\WeixinController@getmedia');
Route::get('/wx/info','Weixin\WeixinController@info');
Route::get('/token','Weixin\WeixinController@flushAccessToken');

//微信公众号
Route::get('/weixin/menu','Weixin\WeixinController@createmenu');

Route::get('/vote','VoteController@index');//微信投票

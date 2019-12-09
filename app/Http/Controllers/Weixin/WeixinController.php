<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeixinController extends Controller
{

        public function weixin()
        {
            $signature = $_GET["signature"];
            $timestamp = $_GET["timestamp"];
            $nonce = $_GET["nonce"];
            $token = 'acb5as840asd316asd268asd';
            $tmpArr = array($token, $timestamp, $nonce);
            sort($tmpArr, SORT_STRING);
            $tmpStr = implode( $tmpArr );
            $tmpStr = sha1( $tmpStr );

            if( $tmpStr == $signature ){
                echo $_GET['echostr'];
            }else{
                die('not ok');
            }
        }
        /*
        * 接收微信推送事件
         */
        public function receiv(){
            $log_file="wx.log";
            //将接受到的数据记录到日志文件
            $data=json_encode($_POST);
            file_put_contents($log_file,$data,FILE_APPEND);//追加写;
        }
        //获取用户基本信息
        public function getuserinfo(){
            $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN';
        }

}

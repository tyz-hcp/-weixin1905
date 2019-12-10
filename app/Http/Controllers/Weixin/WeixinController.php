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
            $postSty = file_get_contents("php://input");
            file_put_contents("1.txt",$postSty);
            //处理xml格式的数据  将xml格式的数据  转换xml格式的对象
            $postObj = simplexml_load_string($postSty);
            echo "<xml>
                  <ToUserName><![CDATA[toUser]]></ToUserName>
                  <FromUserName><![CDATA[FromUser]]></FromUserName>
                  <CreateTime>123456789</CreateTime>
                  <MsgType><![CDATA[event]]></MsgType>
                  <Event><![CDATA[subscribe]]></Event>
                </xml>";die;
        }
        //获取用户基本信息
        public function getuserinfo(){
            $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN';
        }
        public function aaa(){
            aaaa;
        }

}

<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WxUsermodel;

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

            public  function  receiv(){
                $log_file="wx.log";
                $xml_str=file_get_contents("php://input");
                //将接收的"数据记录到日志文件
                $data=date("Y-m-d H:i:s").$xml_str;
                file_put_contents($log_file,$data,FILE_APPEND);
                //处理xml数据
                $xml_obj=simplexml_load_string($xml_str);
                $event=$xml_obj->Event; //类型
                if($event=='subscribe'){
                    $openid=$xml_obj->FromUserName;    //获取用户的openid
                    //判断用户是否已经存在
                    $u=WxUsermodel::where(['openid'=>$openid])->first();
                    if($u){
                        //TODO 欢迎回来
                        echo "欢迎回来";die;
                    }else{
                        $user_data=[
                            'openid' => $openid,
                            'sub_time'=>$xml_obj->CreateTime,
                        ];

                        //openid 入库
                        $uid= WxUsermodel::insertGetId($user_data);
                        var_dump($uid);die;
                    }

                }
                //判断消息类型
                $msg_type = $xml_obj->MsgType;
                $touser = $xml_obj->FromUserName;           //接收消息得到用户openid
                $formuser = $xml_obj->ToUserName;           //自己开发的公众号的id
                $time = time();
                if($msg_type=='text'){
                    $content = date('Y-m-d H:i:s').$xml_obj->Content;
                    $response_text = '<xml>
                <ToUserName><![CDATA['.$touser.']]></ToUserName>
                <FromUserName><![CDATA['.$formuser.']]></FromUserName>
                <CreateTime>'.$time.'</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA['.$content.']]></Content>
                </xml>
                ';
                    echo $response_text;        //回复用户消息
                }
            }

        //获取用户基本信息
        public function getuserinfo(){
            $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN';
        }
        public function aaa(){
            aaaa;
        }

}

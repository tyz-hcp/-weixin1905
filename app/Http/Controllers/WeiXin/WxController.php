<?php
namespace App\Http\Controllers\Weixin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WxUsermodel;
class WeixinController extends Controller
{
    protected $access_token;
    public function __construct(){
        //获取access_token
        $this->access_token=$this->getAccessToken();
    }
    public function getAccessToken(){
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WX_APPID').'&secret='.env('WX_APPSECRET');
        $data_json = file_get_contents($url);
        $arr = json_decode($data_json,true);
        return $arr['access_token'];
    }
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
        $data=date("Y-m-d H:i:s").">>>>>>>\n".$xml_str."\n\n";
        file_put_contents($log_file,$data,FILE_APPEND);
        //处理xml数据
        $xml_obj=simplexml_load_string($xml_str);
        $event=$xml_obj->Event; //类型
        if($event=='subscribe'){
            $openid=$xml_obj->FromUserName;    //获取用户的openid
            //判断用户是否已经存在
            $u=WxUsermodel::where(['openid'=>$openid])->first();
            if($u){
                $msg='欢迎回来';
                $xml='<xml>
                              <ToUserName><![CDATA['.$openid.']]></ToUserName>
                              <FromUserName><![CDATA['.$xml_obj->ToUserName.']]></FromUserName>
                              <CreateTime>'.time().'</CreateTime>
                              <MsgType><![CDATA[text]]></MsgType>
                              <Content><![C DATA['.$msg.']]></Content>
                            </xml>';
                echo $xml;
            }else{
                //获取用户信息
                $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->access_token.'&openid='.$openid.'&lang=zh_CN';
                $user_info=file_get_contents($url);
                $u=json_decode($user_info,true);
                $user_data=[
                    'openid'    => $openid,
                    'nickname'  =>$u['nickname'],
                    'sex'        =>$u['sex'],
                    'headimgurl'=>$u['headimgurl'],
                    'subscribe_time'=>$u['subscribe_time']
                ];
//                        $log_content=data('Y-m-d H:i:s').">>>>>".$user_info."\n";
//                        file_put_contents("wx_user.log",$user_info,FILE_APPEND);
                //openid 入库
                $uid= WxUsermodel::insertGetId($user_data);
                //回复用户关注
                $msg="谢谢关注";
                $xml='<xml>
                              <ToUserName><![CDATA['.$openid.']]></ToUserName>
                              <FromUserName><![CDATA['.$xml_obj->ToUserName.']]></FromUserName>
                              <CreateTime>'.time().'</CreateTime>
                              <MsgType><![CDATA[text]]></MsgType>
                              <Content><![CDATA['.$msg.']]></Content>
                            </xml>';
                echo $xml;
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
?>

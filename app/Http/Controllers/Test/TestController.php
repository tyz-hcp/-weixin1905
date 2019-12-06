<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;

class TestController extends Controller
{
    public function hello(){
        echo "hello World123131231321";
    }

    public function adduser(){

        $pass ='123';
        $email='asdas';
        //使用秘钥函数
        $password = password_hash($pass,PASSWORD_BCRYPT);

        $data=[
            'user_name'=>'yyp',
            'password'=>$password,
            'email'=>$email
        ];
       $res=UserModel::insertGetId($data);
        var_dump($res);
    }
}

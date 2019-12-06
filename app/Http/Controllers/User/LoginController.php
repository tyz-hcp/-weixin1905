<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Model\UserModel;
use Illuminate\Http\Request;

class LoginController extends Controller 
{
    public function addUser(){
        $pass =  'tyztyx';
         $password=password_hash($pass,PASSWORD_BCRYPT);
        $email ="ink";
        $user_name = Str::random(8);



        $data =[
            'user_name'=>'tianyi',
            'password'=>$password,
            'email' => $email,

        ];
         $uid=  UserModel::insertGetId($data);
         var_dump($uid);
    }
}

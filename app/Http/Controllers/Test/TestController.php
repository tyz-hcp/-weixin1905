<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
	public function hello()
	{
		echo "Hello World 1905  aaaaa";
	}
}




		public function redisa1()
		{
			$key = 'weixin';
			$val = 'hello world';
			Redis::set($key,$val);

			echo time();echo '</br>';
			echo date('Y-m-d H:i:s');
		}
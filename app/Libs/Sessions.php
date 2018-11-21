<?php

namespace App\Libs;


class Sessions{
	static public function init(){
		session_start();
	}
	static public function set($key, $value){
		$_SESSION[$key]=$value;
	}
	static public function get($key){
		return (isset($_SESSION[$key]))?$_SESSION[$key]:false;
	}
	static public function del($key){
		unset($_SESSION[$key]);
	}
	static public function clear(){
		session_destroy();
	}
}
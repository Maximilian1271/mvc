<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 21/11/2018
 * Time: 08:25
 */

namespace App\Controllers;


class Logout{
	public function index(){
		echo "You have been logged out successfully";
		session_destroy();
	}
}
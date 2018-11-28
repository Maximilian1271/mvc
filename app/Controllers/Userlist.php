<?php
/**
 * Created by PhpStorm.
 * User: maximilian
 * Date: 28/11/18
 * Time: 15:22
 */

namespace App\Controllers;


use App\Core\UserController;
use App\models\User;

class Userlist extends UserController{
	public function index(){
		$user=new User();
		$data['list']=$user->getAll();
		$this->view->render("userlist/index", $data);
	}
	public function user($uname=null){
		//print_r($_GET);
	//	$uname=explode("/", $_GET['url']);
	//	$uname=end($uname);
		//

		if ($uname!=null){
			$user=new User();
			$data['user']=$user->getUserByUname($uname);
			if ($data['user']!==false) {
				$this->view->render("userlist/user", $data);
			}else header("Location:".APP_URL."userlist");
		}
	}
}
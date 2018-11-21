<?php

namespace App\Controllers;

use App\Libs\Formbuilder;
use App\Core\Controller;
use App\Libs\Sessions;
use App\Libs\Validator;
use App\models\User;

class Login extends Controller{
	public function index(){
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
			$data['errors'] = $this->login();
		}
		$form = new Formbuilder("login");
		$form
			->addInput("text", "uname", "Username")
			->addInput("password", "pw", "Passwort")
			->addButton("send-login", "Login");
		$data['form'] = $form->output();
		$this->view->render("login/index", $data);
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->login();
		}
	}
	public function login() {
		$user=new User();
		$account = $user->getUserByUname($_POST['uname']);
		$form=new Validator();
		$form->val($_POST['uname'], "Username", true, "textnum", 3, 30);
		$form->val($_POST['pw'], "Passwort", true, "textnum", 5, 30);
		$pw = $_POST['pw'];
		$pw_hash = explode(":", $account['password']);

		if($form->getErrors()===false) {
			if ($account["uname"] == $_POST['uname'] && sha1($pw . $pw_hash[1]) == $pw_hash[0]) {
				if($account['is_active']==1){
					Sessions::set("uname", $account['uname']);
					Sessions::set("login", true);
					header("Location:".APP_URL."dashboard");
//					$_SESSION['uname']=$account['uname'];
//					$_SESSION['login']=true;
					$this->success();
				} else return $form->getErrors(5);
			} else return $form->getErrors(6);
		} else return $form->getErrors();
	}
}
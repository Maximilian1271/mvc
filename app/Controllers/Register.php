<?php

namespace App\Controllers;

use App\Core\GuestController;
use App\Libs\Formbuilder;
use App\Libs\PHPMailer;
use App\Libs\Validator;
use App\models\User;
class Register extends GuestController
{
	public function index()
	{
		if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
			$data['errors']=$this->formSuccess();
		}
		$form = new Formbuilder("register", 2);
		$form
			->addInput("text", "fname", "Firstname")
			->addInput("text", "lname", "Lastname")
			->addInput("text", "uname", "Username")
			->addInput("email", "email", "E-Mail")
			->addInput("tel", "tel", "Telephone")
			->addSelect("country", "Country", ['at' => 'Austria', 'de' => 'Germany'])
			->addInput("password", "pw", "Password")
			->addInput("password", "pw-repeat", "Password repeat")
			->addButton("set-register", "Register now")
		;

		$data['form'] = $form->output();

		$this->view->render("register/index", $data);
	}
	private function formSuccess()
	{
		if (check_csrf($_POST['csrf'])) {
			$val = new Validator();
			$val->val($_POST['fname'], "Vornamen", true, "text", 3, 30);
			$val->val($_POST['lname'], "Nachname", true, "text", 3, 30);
			$val->val($_POST['uname'], "Username", true, "textnum", 3, 30);
			$val->val($_POST['email'], "E-Mail", true, "email", 3, 30);
			$val->val($_POST['tel'], "Telefonnummer", true, "tel", 3, 30);
			$val->val($_POST['pw'], "Passwort", true, "textnum", 3, 30);

			$val->check([$_POST['pw'], "Passwort"], [$_POST['pw-repeat'], "Passwort Wiederholung"]);

			if(!$val->getErrors()){
				$user=new User();
				if($user->checkUname($_POST['uname'])){
					$val->getErrors(7);
				}
				if($user->checkEmail($_POST['email'])){
					$val->getErrors(8);
				}
				if($val->getErrors()!==false){
					return $val->getErrors();
				}
					$hash=$user->setUser($_POST['uname'], $_POST['email'], $_POST['pw'], $_POST['fname'],$_POST['lname'], $_POST['tel'], $_POST['country']);
					$mail=new PHPMailer();
					$mail->IsHTML(true);
					$mail->AddAddress($_POST['email'], $_POST['fname']."".$_POST['lname']);
					$mail->SetFrom("maximilian.schaumann@gmail.com", "Maximilian Schaumann");
					$mail->Subject="Registrierung Abschließen";
					$link=APP_URL."register/activate/".$hash;
					$message="<p>Danke für deine Registrierung. Bitte klicke den link um die registrierung abzuschließen</p><p><a href='$link'>Klicke hier um die Registrierung abzuschließen</a></p>";
					$mail->Body=$message;

					if($mail->Send()) {
						header("Location:" . APP_URL . "register/success");
						exit();
					}
			}else return $val->getErrors();
		}
	}
	public function success(){
		$this->view->render("register/success");
	}
	public function activate($hash=null){
		if ($hash!=null){
			$user=new User();
			$is_active=$user->checkActiveStatusByHash($hash);

			if($is_active===false){
				$data['text']="Etwas ist schief gelaufen bitte probiere es später noch einmal";
			}else{
				if ($is_active==1){
					$data['text']="Dieser account wurde bereits aktiviert";
				}
				else{
					$user->setActiveStatus();
					$data['text']="Du wurdest aktiviert. Du kannst dich nun einloggen";
				}
			}
		}
		else{
			$data['text']="Etwas ist schief gegangen!";
		}
		$this->view->render("register/activate", $data);
	}
}
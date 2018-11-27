<?php
/**
 * Created by PhpStorm.
 * User: maximilian
 * Date: 26/11/18
 * Time: 15:32
 */

namespace App\Controllers;


use App\Core\UserController;
use App\Libs\Formbuilder;
use App\Libs\Sessions;
use App\Libs\Validator;
use App\models\User;

class Profile extends UserController
{
    public function index()
    {
	    $id = Sessions::get("id");
	    $user = new User();
	    $data['user'] = $user->getUserbyId($id);
	    $this->view->render("profile/index", $data);
    }
    public function edit(){
    	if (!empty($_POST)&&$_SERVER['REQUEST_METHOD']=="POST"){
    		$data['errors']=$this->formSuccess();
	    }
    	$id=Sessions::get("id");
    	$user=new User();
    	$user_data=$user->getUserbyId($id);
    	$user_data_pers=json_decode($user_data['data'], true);
    	$form=new Formbuilder("profile-update");
    	$form->addInput("text", "fname", "Vorname", ["value"=>$user_data_pers['fname']]);
	    $form->addInput("text", "lname", "Nachname", ["value"=>$user_data_pers['lname']]);
	    $form->addInput("tel", "tel", "Telephone", ["value"=>$user_data_pers['tel']]);
//	    $form->addSelect("country", "Country", ['at' => 'Austria', 'de' => 'Germany']);
	    $form->addButton("submit", "Änderung Übernehmen");
	    $data['form']=$form->output();
	    $this->view->render("profile/edit", $data);
    }
    private function formSuccess(){
    	if (check_csrf($_POST['csrf'])){
    		//val
		    //wenn keine fehler dann update
		    $val=new Validator();
		    $val->val($_POST['fname'], "Vorname", true, "text", 3, 30);
		    $val->val($_POST['lname'], "Nachname", true, "text", 3, 30);
		    $val->val($_POST['tel'], "Telefonnummer", true, "tel", 3, 30);
		    if ($val->getErrors()==false){
			    $id=Sessions::get("id");
			    $user=new User();
			    $user->updateUserById($id, $_POST);
			    header("Location:".APP_URL."profile/index");
		    }else return $val->getErrors();
	    }
    }
}
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
use App\Models\User;

class Profile extends UserController
{
    public function index()
    {
	    $id = Sessions::get("user_id");
	    $user = new User();
	    $data['user'] = $user->getUserbyId();
	    $this->view->render("profile/index");
    }
    public function edit(){
    	if (!empty($_POST)&&$_SERVER['REQUEST_METHOD']=="POST"){
    		$this->formSuccess();
	    }
    	$id=Sessions::get("id");
    	$user=new User();
    	$user_data=$user->getUserbyId($id);
    	$user_data_pers=json_decode($user_data, true);
    	$form=new Formbuilder();
    	$form->addInput("text", "fname", "Vorname", ["value"=>$user_data['fname']]);
	    $form->addInput("text", "lname", "Nachname", ["value"=>$user_data['lname']]);
	    $data['form']=$form->output();
	    $this->view->render("profile/edit", $data);

    }
    private function formSuccess(){
    	if (check_csrf($_POST['csrf'])){
    		//val
		    //wenn keine fehler dann update
		    $id=Sessions::get("id");
		    $user=new User();
			$user->updateUserById($id);
	    }
    }
}
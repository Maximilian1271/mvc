<?php
/**
 * Created by PhpStorm.
 * User: maximilian
 * Date: 21/11/18
 * Time: 17:12
 */

namespace App\Core;
use App\Libs\Sessions;

class UserController extends Controller {
	public function __construct()
	{
		parent::__construct();
		$this->checkGroup();
	}
	private function checkGroup(){
		if(Sessions::get('login')!=1||Sessions::get('user_group')<0){
			header("Location".APP_URL."login");
		}
	}
}
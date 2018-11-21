<?php
/**
 * Created by PhpStorm.
 * User: maximilian
 * Date: 21/11/18
 * Time: 16:41
 */

namespace App\Controllers;
use App\Core\Controller;

class Dashboard extends Controller{
	public function index(){
		$this->view->render("dashboard/index");
	}
}
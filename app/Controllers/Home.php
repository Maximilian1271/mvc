<?php
namespace App\Controllers;
use App\Core\Controller;

class Home extends Controller {
	public function index(){
		$this->view->files_css=[
			'assets/css/home.css',
			'assets/css/load.css',
		];
		$this->view->files_js=[
			'assets/css/home.js',
		];
		$data=[
			"headline"=>"Willkommen bei MVC",
			"text"=>"Das ist irgendein text",
		];
		$this->view->render("home/index", $data);
	}
	public function show($id=null){
		$this->view->render("home/show");
	}
}
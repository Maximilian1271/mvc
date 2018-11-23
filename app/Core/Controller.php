<?php

namespace App\Core;


class Controller 
{
	public $view;
	public function __construct()
	{
		$this->view=new View();
	}
	public function insertCSS($filename){
		if (file_exists("./assets/css/{$filename}")){
			echo "<link rel=\"stylesheet\" href=\"/mvc/assets/css/{$filename}\">";
		}
	}
}
<?php

namespace App\Core;
use App\Controllers\Error;
use App\Controllers\Home;
class Bootstrap
{
	public function __construct(){
		$url = (isset($_GET['url'])) ? $_GET['url'] : "Home";
		$url = rtrim($url, "/");
		$url = explode("/", $url);
		$controller_name = ucfirst($url[0]);
		$controller_file = __DIR__ . '/../Controllers/' . $controller_name . '.php';
		if (file_exists($controller_file)) {
			$controller_namespace = "App\\Controllers\\$controller_name";
			$controller = new $controller_namespace;
			if (isset($url[1]) && method_exists($controller, $url[1])) {
				$controller_method = $url[1];
				if (isset($url[2]) && !empty($url[2])) {
					$controller->$controller_method($url[2]);
				} else {
					$controller->$controller_method();

				}
			} else {
				$controller->index();
			}
		} else {
			$controller = new Error();
		}
	}
}

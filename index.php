<?php

use App\Core\Bootstrap;
use App\Libs\Sessions;

spl_autoload_register(function($class){
	$path=str_replace("App\\", "app/", $class);
	$path=str_replace("\\", "/", $path);

	$path=__DIR__."/".$path.".php";

	if (file_exists($path)){
		require $path;
	}
});
Sessions::init();
require __DIR__."/config/paths.php";
require __DIR__."/app/helper.php";
$app= new Bootstrap();
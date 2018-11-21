<?php
use \App\Libs\Sessions;

function load_view($view, $data=array()){
	if(count($data)>0)extract($data);
	require __DIR__."/../views/sites/".$view.".php";
}
function load_global($global){
	require __DIR__."/../views/globals/".$global.".php";
}
function set_csrf(){
	$csrf=uniqid();
	Sessions::set("csrf", $csrf);
	return $csrf;
}
function check_csrf($csrf){
	return (Sessions::get("csrf")==$csrf)?true:false;
}
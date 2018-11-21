<?php
namespace App\Libs;

class Database extends \mysqli
{
	public function __construct()
	{
		$db_config=require __DIR__."/../../config/db.php";
		parent::__construct($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['name']);
	}
}
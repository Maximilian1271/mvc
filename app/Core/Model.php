<?php
namespace App\Core;

use App\Libs\Database;

class Model{
	public $db;
	protected $tablename;
	public function __construct(){
		$this->db = new Database();
	}
	public function insert($data=array()){
		//["uname"=>"test", "password"=>sha1()"]
		if(count($data)>0){
			$sql="INSERT INTO ".$this->tablename." SET ";
			$end=array_keys($data);
			$end=end($end);
			foreach ($data as $key=>$item){
				if($end==$key){
					$sql.="$key='$item'";
				}
				else{
					$sql.="$key='$item',";
				}
			}
			$this->db->query($sql);
		}
	}
	public function get($id=null){
		if(id!==null){
			$sql="SELECT * FROM ".$this->tablename." WHERE id=$id";
		}
		else{
			$sql="SELECT * FROM ".$this->tablename;
		}
		$res=$this->db->query($sql);
		return $res->fetch_all(MYSQLI_ASSOC);
	}
}
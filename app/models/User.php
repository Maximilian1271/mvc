<?php

namespace App\Models;

use App\Core\Model;

class User extends Model {
	protected $table_name = "users";

	public function setUser($uname, $email, $password, $fname, $lname, $tel, $country){
		$user_group = 0;
		$created_at = time();
		$data = [
			'fname'=> $fname,
			'lname' => $lname,
			'tel' => $tel,
			'country' => $country
		];
		$data = json_encode($data);
		$hash = uniqid();
		$is_active = 0;

		$salt = $this->generateSalt();
		$pw = sha1($password . $salt) . ":" . $salt;

		$stmt = $this->db->prepare("INSERT INTO {$this->table_name} (uname, email, password, data, user_group, hash, is_active, created_at) Values (?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssisis",$uname, $email, $pw, $data, $user_group, $hash, $is_active, $created_at);
		$stmt->execute();
		return $hash;
	}
	public function getUserByUname($username){
		$res = $this->db->query("SELECT * FROM {$this->table_name} WHERE uname ='$username'");
		if ($res->num_rows===0){
			return false;
		}
		else{
			$account = $res->fetch_assoc();
			return $account;
		}

	}
	private function generateSalt(){
		return rand (1000,9999);
	}

	public function setActiveStatus($status = 1){
		$this->db->query("UPDATE {$this->table_name} SET is_active = $status");
	}

	public function checkActiveStatusByHash($hash = null){
		$res = $this->db->query("SELECT is_active FROM {$this->table_name} WHERE hash = '$hash' LIMIT 1");
		if ($res->num_rows > 0 ) {
			$row = $res->fetch_assoc();
			return $row['is_active'];
		}else {
			return false;
		}
	}
	public function checkUname($uname=null){
		if($uname!=null){
			if($this->db->query("SELECT id FROM {$this->table_name} WHERE uname='$uname' LIMIT 1")->num_rows==1){
				return true;
			}else return false;
		}
	}
	public function checkEmail($email){
		if($email!=null){
			if($this->db->query("SELECT id FROM {$this->table_name} WHERE email='$email' LIMIT 1")->num_rows==1){
				return true;
			}else return false;
		}
	}
	public function getUserbyId($id=null){
		if ($id!=null){
			$res=$this->db->query("SELECT * FROM {$this->table_name} WHERE id=$id");

			if ($res->num_rows>0){
				return $res->fetch_assoc();
			}
			else return false;
		}
	}
	public function updateUserById($id=null, $data){
		if ($id!=null){
			$user_data=[
				"fname"=> $data['fname'],
				"lname"=>$data['lname'],
				"tel"=>$data['tel'],
				"country"=>$data['country']
			];
			$user_data=json_encode($user_data);
			$this->db->query("UPDATE {$this->table_name} SET data='$user_data' WHERE id=$id");
		}
	}
	public function getAll(){
		$res=$this->db->query("SELECT * FROM {$this->table_name}")->fetch_all(MYSQLI_ASSOC);
		return $res;
	}
	public function getIdsByUnames($unames=array()){
		$userids=array();
		foreach ($unames as $uname){
			$res=$this->db->query("SELECT id FROM {$this->table_name} WHERE uname='$uname' LIMIT 1");
			if ($res->num_rows>0){
				$user=$res->fetch_assoc();
				array_push($userids, $user['id']);
			}
		}
	}
}
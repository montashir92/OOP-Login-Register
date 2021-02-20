<?php
require "config.php";

class LoginRegistration{
	
	function __construct(){
		$database = new DatabaseConnection();
	}
	public function registerUser($username,$password,$name,$email,$website){
		global $pdo;

		$query = $pdo->prepare("SELECT id FROM users WHERE username = ? AND email = ?");
		$query->execute(array($username, $email));
		$num = $query->rowCount();

		if ($num == 0) {
			$query= $pdo->prepare("INSERT INTO users (username,password,name,email,website) VALUES (?, ?, ?, ?, ?)");
			$query->execute(array($username,$password,$name,$email,$website));
			return true;
		}else{
			return print "<span style='color:red'>Error...username/emil already used.</span>";
		}

	}

	public function loginUser($email, $password){
		global $pdo;
		$query = $pdo->prepare("SELECT id, username FROM users WHERE email =? AND password =?");
		$query->execute(array($email, $password));
		$userdata = $query->fetch();

		$num = $query->rowCount();
		if ($num == 1) {
			session_start();
			$_SESSION['login'] = true;
			$_SESSION['uid'] = $userdata['id'];
			$_SESSION['uname'] = $userdata['username'];
			$_SESSION['login_msg'] = 'login Successfully..';
			return true;
		}else{
			return false;
		}
	}

	public function getAllusers(){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getSession(){
		return @$_SESSION['login'];

	}

	public function getUsername($uid){
		global $pdo;
		$query = $pdo->prepare("SELECT name FROM users where id = ?");
		$query->execute(array($uid));
		$result = $query->fetch();
		echo $result['name'];
	}

	public function getUserById($id){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM users where id = ?");
		$query->execute(array($id));
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function updateUser($uid,$username,$name,$email,$website){
		global $pdo;
		$query = $pdo->prepare("UPDATE users SET username = ?, name=?, email=?, website=? WHERE id=?");
		$query->execute(array($username, $name, $email, $website, $uid));
		return true;
	}

	public function getUserDetails($userid){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM users WHERE id = ?");
		$query->execute(array($userid));
		return $query->fetchAll(PDO::FETCH_ASSOC);

	}


	public function updatePassword($uid, $new_pass, $old_pass){
		global $pdo;
		$query = $pdo->prepare("SELECT id FROM users WHERE password = ?");
		$query->execute(array($old_pass));
		$num = $query->rowCount();

		if ($num == 0) {
			return print("<span style='color:red'>Old Password not Exist.</span>");
		}else{
			$query = $pdo->prepare("UPDATE users SET password =? WHERE id =?");
			$query->execute(array($new_pass, $uid));
			return print("<span style='color:green'>Password Change Successfully...</span>");
		}

	}


	public function logOutUser(){
		$_SESSION['login'] = false;
		unset($_SESSION['uid']);
		unset($_SESSION['uname']);
		session_destroy();
	}


}

?>
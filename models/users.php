<?php
	include_once($PROJECT_ROOT . "models/database.php");

	//infos users
	function getInfosUsersById($id)
	{
		global $db;

		$req = $db->prepare("SELECT id, lastname, firstname, email, password, admin FROM users WHERE id = ?");
		$req->execute(array($id));
		$data = $req->fetch(PDO::FETCH_OBJ);
		return($data);	
	}
	function getInfosUsersByEmail($email)
	{
		global $db;

		$req = $db->prepare("SELECT id, lastname, firstname, email, password, admin FROM users WHERE email = ?");
		$req->execute(array($email));
		$data = $req->fetch(PDO::FETCH_OBJ);
		return($data);	
	}
	function isExistingEmail($email)
	{
		global $db;
		
		$req = $db->prepare('SELECT email FROM users WHERE email = ?');
		$req->execute(array($email));
		$bool = $req->fetch(PDO::FETCH_OBJ);
		
		return !empty($bool)?true:false;
	}

	function addUser($email, $pwd, $lastname, $firstname)
	{
		global $db;
		
		$pwd = sha1($pwd);
		$req = $db->prepare("INSERT INTO users (email, password, lastname, firstname) VALUES (?,?,?,?)");
		$req->execute( [ $email, $pwd, $lastname, $firstname ] );
	}

	function isAdmin($id)
	{
		global $db;

		$req = $db->prepare('SELECT admin FROM users WHERE id = ?');
		$req->execute(array($id));
		$bool = $req->fetch(PDO::FETCH_OBJ);
		return $bool->admin==1 ? true : false;
	}
?>

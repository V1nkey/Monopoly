<?php
	include_once($PROJECT_ROOT . "models/database.php");

	//infos users
	function getInfosByUserId($id)
	{
		global $db;

		$req = $db->prepare("SELECT * FROM users WHERE id = ?");
		$req->execute(array($id));
		$data = $req->fetch(PDO::FETCH_OBJ);
		return($data);	
	}
	function getInfosByUserEmail($email)
	{
		global $db;

		$req = $db->prepare("SELECT * FROM users WHERE email = ?");
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
		$req = $db->prepare("INSERT INTO users (email, password, lastname, firstname, registered_at) VALUES (?,?,?,?,?)");
		$req->execute( [ $email, $pwd, $lastname, $firstname, time() ] );
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

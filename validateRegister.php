<?php
	include_once("models/sessions.php");
	include_once("models/tUsers.php");

	$email = htmlentities(mysql_real_escape_string($_POST['email']));
	$lastname = htmlentities(mysql_real_escape_string($_POST['lastname']));
	$firstname = htmlentities(mysql_real_escape_string($_POST['firstname']));
	$password = htmlentities(mysql_real_escape_string($_POST['password']));
	$password_confirm = htmlentities(mysql_real_escape_string($_POST['password_confirm']));

	if( empty($_POST['password']) or empty($_POST['password_confirm']) or empty($_POST['email']) or empty($_POST['lastname']) or empty($_POST['firstname']) )
		Header('Location: register.php?err=1');

	else if($_POST['password'] != $_POST['password_confirm'])
		Header('Location: register.php?err=2');

	else if( !filter_var( filter_var( $email, FILTER_SANITIZE_EMAIL) , FILTER_VALIDATE_EMAIL) )
		Header('Location: register.php?err=3');

	else if( isExistingEmail($email) ) //Le mail existe
		Header('Location: register.php?err=4');

	else if( !preg_match("#^[a-zA-Z]+[\s-]?[a-zA-Z]?$#", $lastname)) //Le nom n'est pas Alpha
		Header('Location: register.php?err=5');

	else if( !preg_match("#^[a-zA-Z]+[\s-]?[a-zA-Z]?$#", $firstname)) //Le prenom n'est pas Alpha
		Header('Location: register.php?err=6');

	else if( !preg_match("#^[a-zA-Z0-9]+$#", $password))
		Header('Location: register.php?err=7');

	else
	{
		$lastname = strtoupper( $lastname );
		$firstname = ucfirst( strtolower($firstname) );
		
		addUser($email, $password, $lastname, $firstname);
		
		Header('Location: ./');
	}


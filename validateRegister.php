<?php
	include_once("models/sessions.php");
	include_once("models/tUsers.php");

	if( empty($_POST['password']) or empty($_POST['password_confirm']) or empty($_POST['email']) or empty($_POST['lastname']) or empty($_POST['firstname']) )
		Header('Location: register.php?err=1');

	else if($_POST['password'] != $_POST['password_confirm'])
		Header('Location: register.php?err=2');

	else if( !filter_var( filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL) , FILTER_VALIDATE_EMAIL) )
		Header('Location: register.php?err=3');

	else if( isExistingEmail($_POST['email']) ) //Le mail existe
		Header('Location: register.php?err=4');
	else
	{
		$lastname = strtoupper( $_POST['lastname'] );
		$firstname = ucfirst( strtolower($_POST['firstname'] ) );
		
		addUser($_POST['email'], $_POST['password'], $lastname, $firstname );
		
		Header('Location: ./');
	}


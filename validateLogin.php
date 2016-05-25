<?php
// Includes divers
include_once("models/sessions.php");
include_once("models/users.php");

// Si l'email n'a pas été envoyée, ou si l'email n'existe pas, ou si l'email est invalide on renvoie le code d'erreur 1
if( !isset( $_POST['email'] ) or !isExistingEmail( $_POST['email'] ) or !filter_var( filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL) , FILTER_VALIDATE_EMAIL) )
	header('Location: login.php?err=1');
else
{
	// Sinon on vérifie le mot de passe, en fonction de celui de la base
	$user = getInfosUsersByEmail($_POST['email']);
		
	if( sha1($_POST['password']) != $user->password )
		header('Location: login.php?err=2');
	else
	{
		$_SESSION['auth']->id = $user->id;
		$_SESSION['auth']->password = $user->password;
		header("location: ./");
	}
}


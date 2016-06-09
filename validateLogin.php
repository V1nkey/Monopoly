<?php
// Includes divers
include_once("models/sessions.php");
include_once("models/tUsers.php");

$email = htmlentities(mysql_real_escape_string($_POST['email']));
$password = htmlentities(mysql_real_escape_string($_POST['password']));

// Si l'email n'a pas été envoyée, ou si l'email n'existe pas, ou si l'email est invalide on renvoie le code d'erreur 1
if( !isset( $email ) or !isExistingEmail( $email ) or !filter_var( filter_var( $email, FILTER_SANITIZE_EMAIL) , FILTER_VALIDATE_EMAIL) )
	header('Location: login.php?err=1');
else
{
	// Sinon on vérifie le mot de passe, en fonction de celui de la base
	$user = getInfosByUserEmail($email);
		
	if( sha1($password) != $user->password )
		header('Location: login.php?err=2');
	else
	{
		$_SESSION['auth']->id = $user->id;
		$_SESSION['auth']->password = $user->password;
		header("location: ./");
	}
}


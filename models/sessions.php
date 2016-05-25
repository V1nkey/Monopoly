<?php
session_start();

$PROJECT_ROOT = dirname(__DIR__) . '/'; //Pour l'accès relatif

include_once($PROJECT_ROOT . 'models/users.php');
//include_once($PROJECT_ROOT . "models/soiree.php");

/**
 *  * Retourne vrai si l'id associé au mot de passe entrés en paramètre existe dans la BDD
 *   */
function isValidID($n, $p)
{	
	if(($u = getInfosUsersById($n)) != null)
		if($u->password == $p)
			return true;
	return false;
}

/**
 *  * Retourne vrai si l'utilisateur est connecté, faux sinon
 *   */
function isLogged()
{
	if( isset( $_SESSION['auth'] ) AND isValidID( $_SESSION['auth']->id, $_SESSION['auth']->password ) )
	{
		return true;
	}
	else
	{
		//unset($_SESSION['auth']);
		return false;
	}
}

/**
 *  * Retourne l'ID de l'utilisateur dont la session est active
 *   */
function getUserID()
{
	return isLogged()?$_SESSION['session_id']:null;
}

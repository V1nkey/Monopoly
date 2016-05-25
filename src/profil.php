<?php
include_once("model/sessions.php");
include_once("model/membres.php");
if(isLogged())
{
	$user = getInfosUsersById(getUserId());
	$uid = getUserId();
}else {
	header('Location: ./');
	exit;
}

$user['NomMembre'] = htmlspecialchars($user['NomMembre']);
$user['PrenomMembre'] = htmlspecialchars($user['PrenomMembre']);
$user['Email'] = htmlentities($user['Email']);

$page_title = 'Profil de '.$user['PrenomMembre'].' ' . $user['NomMembre'];
include_once("view/profil.php");

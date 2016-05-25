<?php
include_once("model/sessions.php");
include_once("model/soiree.php");

if(!isLogged())
{
	Header('Location: ./connexion.php');
	exit(0);
}

$historique = getHistSoiree();

foreach($historique as &$hist)
{
	$hist['NomSoiree'] = htmlspecialchars($hist['NomSoiree']);
}
$user = getInfosUsersById($_SESSION['session_id']);

$page_title = "Historique des soirées";
include_once("view/historiqueSoiree.php");

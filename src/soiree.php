<?php
include_once("model/sessions.php");
include_once("model/soiree.php");
include_once("model/config.php");
include_once("model/etape.php");
include_once("model/vote.php");

if(isLogged() AND isset($_GET['idSoiree']))
{
	$idSoiree = $_GET['idSoiree'];
	if(!($data = getSoireeInfoById($idSoiree)))
	{
		header('Location: ./');
	}
}else {
	header('Location: ./');
	exit;
}
$data['NomSoiree'] = htmlspecialchars($data['NomSoiree']);
$data['DateSoiree'] = htmlspecialchars($data['DateSoiree']);

$configs = getConfigsBySoiree($_GET['idSoiree']);

$etapes = Array();

foreach($configs as &$conf)
{
	$conf['Commentaire'] = htmlspecialchars($conf['Commentaire']);
	$etapes[] = getEtapes($conf['IdConfig']);
}


if( getSoireeVoteFermerById($idSoiree) )
{
	$votesClos = true;
}
else
{
	$votesClos = false;
}

$user = getInfosUsersById($_SESSION['session_id']);
$page_title = "soiree " .$data['NomSoiree']. "";
include_once("view/soiree.php");


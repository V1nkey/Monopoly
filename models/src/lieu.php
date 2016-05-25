<?php
	include_once($PROJECT_ROOT . "model/connectBdd.php");
//select d'un lieu
function getLieu($idLieu)
{
	global $bdd;
	
	$answer = $bdd->prepare("SELECT name,lat,lng,adresseVille,adresseCp,adresseRue,adresseNum,type WHERE idLieu = ?");
	$answer->execute(array($idLieu));
	$data = $answer->fetch(PDO::FETCH_ASSOC);
	return ($data);
}
//tout les lieu 
function getLieuIdName()
{
	global $bdd;
	
	$answer = $bdd->prepare("SELECT name, idLieu FROM lieux");
	$answer->execute([]);
	$data = $answer->fetchAll(PDO::FETCH_ASSOC);
	return ($data);
}
//id de lieu par nom
function getLieuIdByName($name)
{
	global $bdd;
	
	$answer = $bdd->prepare("SELECT idLieu FROM lieux WHERE name = ?");
	$answer->execute(array($name));
	$data = $answer->fetch(PDO::FETCH_ASSOC);
	return ($data);
}
?>

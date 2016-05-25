<?php
include_once($PROJECT_ROOT . "model/connectBdd.php");

//Soiree encore en vote
function getSoireeVote()
{
	global $bdd;

	$answer = $bdd->prepare("SELECT IdSoiree,NomSoiree,DateSoiree,DateFermetureVote,DateOuvertureVote FROM Soiree WHERE DateFermetureVote > now()");
	$answer->execute([]);
	$data = $answer->fetchAll(PDO::FETCH_ASSOC);
	return($data);	
}
//Soiree plus en vote
function getSoiree()
{
	global $bdd;

	$answer = $bdd->prepare("SELECT IdSoiree,NomSoiree,DateSoiree FROM Soiree WHERE DateFermetureVote < now() and DateSoiree > now()");
	$answer->execute([]);
	$data = $answer->fetchAll(PDO::FETCH_ASSOC);
	return($data);
}
//Soiree plus en vote
function getSoireeVoteFermerById($idSoiree)
{
	global $bdd;

	$answer = $bdd->prepare("SELECT IdSoiree,NomSoiree,DateSoiree FROM Soiree WHERE DateFermetureVote < now() and DateSoiree > now() AND IdSoiree = ?");
	$answer->execute(array($idSoiree));
	$data = $answer->fetch(PDO::FETCH_ASSOC);
	return($data);
}
//get info soiree idSoiree
function getSoireeInfoById($idSoiree)
{
	global $bdd;

	$answer = $bdd->prepare("SELECT IdSoiree, NomSoiree,DateSoiree FROM Soiree WHERE IdSoiree = ?");
	$answer->execute(array($idSoiree));
	$data = $answer->fetch(PDO::FETCH_ASSOC);
	return($data);
}
//suppresion d'une soiree
function supprimerSoiree($idSoiree)
{
		global $bdd;

		$answer = $bdd->prepare("DELETE FROM Soiree WHERE IdSoiree = ?");
		$answer->execute($idSoiree);
}
//historique soiree
function getHistSoiree()
{
	global $bdd;
	
	$answer = $bdd->prepare("SELECT IdSoiree, NomSoiree,DateSoiree FROM Soiree WHERE DateSoiree < now()");
	$answer->execute([]);
	$data = $answer->fetchAll(PDO::FETCH_ASSOC);
	return($data);
}
//ajouter une soiree
function addSoiree($dateOuvertureVote, $dateFermetureVote, $dateSoiree, $nomSoiree, $idMembre)
{
	global $bdd;
	
	$req = $bdd->prepare('INSERT INTO Soiree (DateOuvertureVote, DateFermetureVote, DateSoiree, NomSoiree, IdMembre) VALUES (?, ?, ?, ?, ?)');
	$req->execute(array($dateOuvertureVote,$dateFermetureVote,$dateSoiree,$nomSoiree, $idMembre));
	$ret = $bdd->query('SELECT MAX(IdSoiree) FROM Soiree');
	return $ret->fetch()[0];
}
//toutes les soirees pas encore passee 
function getFuturSoiree()
{
	global $bdd;
	
	$answer = $bdd->prepare("SELECT IdSoiree, DateOuvertureVote, DateFermetureVote, DateSoiree, IdMembre, NomSoiree FROM Soiree WHERE DateSoiree > now()");
	$answer->execute([]);
	$data = $answer->fetchAll(PDO::FETCH_ASSOC);
	return($data);
}



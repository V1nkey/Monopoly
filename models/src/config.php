<?php
	include_once($PROJECT_ROOT . "model/connectBdd.php");

	function addConfig($idSoiree, $commentaire)
	{
		global $bdd;
		
		$req = $bdd->prepare('INSERT INTO Configuration (IdSoiree, Commentaire) VALUES (:idSoiree, :commentaire)');
		$req->bindParam(':idSoiree', $idSoiree);
		$req->bindParam(':commentaire', $commentaire);
		$ret = $bdd->query('SELECT MAX(IdConfig) FROM Configuration');
		return $ret->fetch()[0];
	}

	function addVoteConfig($idConfig)
	{
		global $bdd;

		$query = $bdd->prepare('UPDATE Configuration SET nbVote  = nbVote + 1 WHERE IdConfig = :idConfig');
		$query->bindParam(':idConfig', $idConfig);
	}

	function getNbVote($idConfig)
	{
		global $bdd;

		$query = $bdd->prepare('SELECT nbVote FROM Configuration WHERE IdConfig = :idConfig');
		return $query->execute(array(
				'idConfig' => $idConfig))->fetch();
	}

	function getConfigsBySoiree($idSoiree)
	{
		global $bdd;

		$query = $bdd->prepare('SELECT IdConfig, Commentaire, nbVote FROM Configuration WHERE IdSoiree = :idSoiree');
		$query->execute(array(
				'idSoiree' => $idSoiree));

		return $query->fetchAll();
	}


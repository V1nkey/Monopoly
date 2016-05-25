<?php
	include_once($PROJECT_ROOT . "model/connectBdd.php");

	function aVote($idMembre, $idConfig)
	{
		global $bdd;

		$query = $bdd->prepare('SELECT COUNT(*) FROM Vote WHERE IdMembre = ? AND IdConfig = ?');
		$res = $query->execute($idMembre, $idConfig);

		if ($res == 0)
			return false;
		else
			return true;
	}

	function nbVoteByMembre($idMembre)
	{
		global $bdd;

		$query = $bdd->prepare('SELECT COUNT(*) as res FROM Vote WHERE IdMembre = ?');
		$query->execute($idMembre);

		$result = $query->fetch();
		return $result['res'];
	}

	function addVote($idConfig,$idMembre)
	{
		global $bdd;

		$req = $bdd->prepare('INSERT INTO Vote VALUES (?, ?)');
		$req->execute(array($idConfig, $idMembre));
	}

	function aVoteSoiree($idMembre, $idSoiree)
	{
		global $bdd;

		$req = $bdd->prepare('SELECT COUNT(*) as res FROM Vote, Configuration WHERE Vote.IdConfig = Configuration.IdConfig AND Configuration.IdSoiree = ? AND Vote.IdMembre = ?');
		$req->execute( array($idSoiree, $idMembre) );
		$result = $req->fetch();
		return $result['res'];
	}

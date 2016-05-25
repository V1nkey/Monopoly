<?php
include_once($PROJECT_ROOT . "models/database.php");

function getNbCardsGeneral() {
	global $db;

	$req = $db->prepare("SELECT COUNT(*) as count FROM cards");
	$req->execute([]);
	$data = $req->fetch(PDO::FETCH_OBJ);
	$nb = $data->count;
	return $nb;
}

function getCardsByUserId($id) {
	global $db;

	$req = $db->prepare("SELECT * FROM cards WHERE idOwner = ?");
	$req->execute( [$id] );

	return $req->fetchAll(PDO::FETCH_OBJ);
}
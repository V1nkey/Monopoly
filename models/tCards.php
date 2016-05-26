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

	$req = $db->prepare("SELECT cards.id, cardtypes.label, cardtypes.color FROM cards, cardtypes WHERE idOwner = ? AND cardTypes.id = cards.idCardType ORDER BY color, label");
	$req->execute( [$id] );

	return $req->fetchAll(PDO::FETCH_OBJ);
}

function insertCard($idUser, $idType) {
	global $db;

	$req = $db->prepare("INSERT INTO cards (idCardType, idOwner) VALUES (?,?)");
	$req->execute( [$idType, $idUser] );
}
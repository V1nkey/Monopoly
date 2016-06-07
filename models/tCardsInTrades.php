<?php
include_once($PROJECT_ROOT . "models/database.php");

function insertIntoCardsInTrades($idCard, $idTrade) {
	global $db;

	$req = $db->prepare( "INSERT INTO cardsintrades VALUES (?,?)" );
	$req->execute( [ $idCard, $idTrade ] );
}

function getCardsInTradesByTradeId($idTrade) {
	global $db;

	$req = $db->prepare( "SELECT cards.id, cardtypes.label, cardtypes.color FROM cards, cardtypes, cardsintrades WHERE cardsintrades.idTrade = ? AND cardsintrades.idCard = cards.id AND cards.idCardType = cardtypes.id");
	$req->execute( [$idTrade] );

	return $req->fetchAll( PDO::FETCH_OBJ );
}

function deleteFromCardInTrades($idCard, $idTrade) {
	global $db;

	$req = $db->prepare( "DELETE FROM cardsintrades WHERE idCard = ? AND idTrade = ?" );
	$req->execute( [$idCard, $idTrade] );
}
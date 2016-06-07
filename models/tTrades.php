<?php
include_once($PROJECT_ROOT . "models/database.php");

function insertIntoTrades($id) {
	global $db;

	$req = $db->prepare( "INSERT INTO trades (dateBegin, idGiver) VALUES (?,?)" );
	$req->execute( [ time(), $id ] );

	return $db->lastInsertId();
}

function getTradesByUserId($id) {
	global $db;

	$req = $db->prepare( "SELECT * FROM trades WHERE idGiver = ? AND trades.status <> '-1' " );
	$req->execute( [ $id ] );
	$trades = $req->fetchAll();

	$index = 0;
	foreach ($trades as $trade) {
		$req = $db->prepare( "SELECT * FROM cardsintrades, cards, cardtypes WHERE cards.id = cardsintrades.idCard AND cards.idCardType = cardtypes.id AND cardsintrades.idTrade = ?");
		$req->execute( [ $trade['id'] ] );
		$cards = $req->fetchAll( PDO::FETCH_OBJ );

		$trades[$index]['cards'] = $cards;

		$index++;
	}

	return $trades;
}

function existsTrade( $id ) {
	global $db;

	$req = $db->prepare("SELECT * FROM trades WHERE id = ?");
	$req->execute( [$id] );

	return $req->rowCount();
}

function updateTradeStatusById($id, $status) {
	global $db;

	$req = $db->prepare( " UPDATE trades SET status = ? WHERE id = ? " );
	$req->execute( [ $status,$id ] );
}

function getTradesByCardType($idCardType) {
	global $db;

	$req = $db->prepare("SELECT DISTINCT trades.id as id, users.firstname as firstname, users.lastname as lastname FROM trades, cardsintrades, cards, users WHERE trades.status = 0 AND trades.id = cardsintrades.idTrade AND cardsintrades.idCard = cards.id AND cards.idOwner = users.id AND cards.idCardType = ?");
	$req->execute( [$idCardType] );
	$trades = $req->fetchAll();
	
	$index = 0;
	foreach ($trades as $trade) {
		$req = $db->prepare( "SELECT * FROM cardsintrades, cards, cardtypes WHERE cards.id = cardsintrades.idCard AND cards.idCardType = cardtypes.id AND cardsintrades.idTrade = ?");
		$req->execute( [ $trade['id'] ] );
		$cards = $req->fetchAll( PDO::FETCH_OBJ );

		$trades[$index]['cards'] = $cards;

		$index++;
	}

	return $trades;
}

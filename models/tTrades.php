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

	$req = $db->prepare( "SELECT * FROM trades WHERE idGiver = ?" );
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

function existsTrade($id) {
	global $db;

	$req = $db->prepare("SELECT * FROM trades WHERE id = ?");
	$req->execute( [$id] );

	return $req->rowCount();
}

function getAllTrades()
{
	global $db;

	$query = $db->query("SELECT * FROM trades WHERE idSeeker != NULL");
	$trades = $query->fetchAll(PDO::FETCH_OBJ);

	$index = 0;
	foreach ($trades as $trade) 
	{
		$query = $db->prepare("SELECT lastname, firstname FROM users WHERE id = ?");
		$query->execute($trade['idGiver']);
		$givers = $query->fetchAll(PDO::FETCH_OBJ);

		$trades[$index]['givers'] = $givers;

		$query = $db->prepare("SELECT lastname, firstname FROM users WHERE id = ?");
		$query->execute($trade['idSeeker']);
		$seekers = $query->fetchAll(PDO::FETCH_OBJ);

		$trades[$index]['seekers'] = $seekers;

		$query = $db->prepare("SELECT ct.label FROM cards c,  cardsintrades cit, cardtypes ct WHERE cit.idTrade = ? AND cit.idCard = c.id AND c.idCardType = ct.id AND c.idOwner = ?");
		$query->execute([ $trade['id'], $trade['idGiver']]);
		$givenCards = $query->fetchAll(PDO::FETCH_OBJ);

		$trades[$index]['givenCards'] = $givenCards;		

		$query = $db->prepare("SELECT ct.label FROM cards c,  cardsintrades cit, cardtypes ct WHERE cit.idTrade = ? AND cit.idCard = c.id AND c.idCardType = ct.id AND c.idOwner = ?");
		$query->execute([ $trade['id'], $trade['idSeeker']]);
		$receivedCards = $query->fetchAll(PDO::FETCH_OBJ);

		$trades[$index]['receivedCards'] = $receivedCards;

		$index++;
	}

	return $trades;
}
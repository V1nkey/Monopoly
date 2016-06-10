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

	$req = $db->prepare("SELECT cards.id AS id, cardtypes.label as typeLabel, cardtypes.color as color, cardstatus.label as statusLabel FROM cards, cardtypes, cardstatus WHERE idOwner = ? AND cardtypes.id = cards.idCardType AND cards.idStatus = cardstatus.idStatus ORDER BY cardtypes.color, cardtypes.label");
	$req->execute( [$id] );

	return $req->fetchAll(PDO::FETCH_OBJ);
}

function getCardsNotProposedByUserId($id) {
	global $db;

	$sql = "
			SELECT cards.id, cardtypes.label, cardtypes.color
			FROM cards, cardtypes
			WHERE cards.idStatus = 1
			AND idOwner = ?
			AND cardTypes.id = cards.idCardType
			ORDER BY color, label
	";
	$req = $db->prepare($sql);
	$req->execute( [$id] );

	return $req->fetchAll(PDO::FETCH_OBJ);
}

function insertCard($idUser, $idType) {
	global $db;

	$req = $db->prepare("INSERT INTO cards (idCardType, idOwner) VALUES (?,?)");
	$req->execute( [$idType, $idUser] );
}

function existsCard($id) {
	global $db;

	$req = $db->prepare("SELECT * FROM cards WHERE id = ?");
	$req->execute( [$id] );

	return $req->rowCount();
}

function checkCardOwner($idCard, $idOwner) {
	global $db;

	$req = $db->prepare("SELECT * FROM cards WHERE id = ? AND idOwner = ?");
	$req->execute( [ $idCard, $idOwner ] );

	return $req->rowCount();	
}

function setCardStatusTo($idCard, $idStatus) {
	global $db;

	$req = $db->prepare("UPDATE cards SET idStatus = ? WHERE id = ?");
	$req->execute( [$idStatus, $idCard] );
}

function getCardsProposedByUserId($id) {
	global $db;

	$req = $db->prepare("SELECT cards.id, cardtypes.label as typeLabel, cardtypes.color, cardstatus.label as statusLabel FROM cards, cardtypes, cardstatus WHERE cards.idOwner = ? AND cards.idStatus = ? AND cardTypes.id = cards.idCardType AND cards.idStatus = cardstatus.idStatus ORDER BY cardtypes.color, cardtypes.label");
	$req->execute( [$id, 2] );

	return $req->fetchAll(PDO::FETCH_OBJ);
}

function getMostTradedCard()
{
	global $db;

	$query = $db->prepare("SELECT ct.label as label, count(cit.idTrade) as nbTrades 
							FROM cards c, cardsintrades cit, cardtypes ct, trades t 
							WHERE cit.idCard = c.id AND c.idCardType = ct.id AND cit.idTrade = t.id AND t.idTradeStatus = 5
							GROUP BY c.idCardType 
							ORDER BY nbTrades DESC 
							LIMIT 1");
	$query->execute([]);

	return $query->fetch(PDO::FETCH_OBJ);
}

function getNbCardBiggestTrade()
{
	global $db;

	$query = $db->prepare("SELECT COUNT(idCard) as nbCard 
							FROM cardsintrades cit 
							WHERE idTrade IN
								(SELECT idTrade FROM trades WHERE idTradeStatus = 5)
							GROUP BY idTrade
							ORDER BY nbCard DESC
							LIMIT 1");
	$query->execute([]);
	$row = $query->fetch(PDO::FETCH_OBJ);
	if(!empty($row))
		$nb = $row->nbCard;
	else
		$nb = 0;
	return $nb;
}

function setCardOwnerTo($idCard, $idOwner) {
	global $db;

	$req = $db->prepare("UPDATE cards SET idOwner = ? WHERE id = ?");
	$req->execute( [$idOwner, $idCard] );
}

function getCardOwnerTo($idCard) {
	global $db;

	$req = $db->prepare("SELECT idOwner FROM cards WHERE id = ?");
	$req->execute( [$idCard] );
	$user = $req->fetch( PDO::FETCH_OBJ );

	return $user->idOwner;
}
<?php
include_once($PROJECT_ROOT . "models/database.php");

function insertIntoTrades($id) {
	global $db;

	$req = $db->prepare( "INSERT INTO trades (dateBegin, idGiver) VALUES (?,?)" );
	$req->execute( [ time(), $id ] );

	return $db->lastInsertId();
}

function getTradesEndedByUserId($id) {
	global $db;
	
	$req = $db->prepare( "	SELECT
								trades.id as id, 
								tradestatus.label as status, 
								trades.dateBegin as dateBegin, 
								trades.idSeeker as idSeeker,
								trades.dateEnd as dateEnd, 
								users.lastname as lastNameGiver, 
								users.firstname as firstNameGiver
							FROM 
								trades, 
								users,
								tradestatus
							WHERE 
								trades.idGiver = ? 
							AND 
								trades.idTradeStatus IN ('3','4','5', '6') 
							AND 
								trades.idTradeStatus = tradestatus.id
							AND
								trades.idGiver = users.id
						" );	
	$req->execute( [ $id ] );
	$trades = $req->fetchAll(PDO::FETCH_OBJ);
	
	$index = 0;
	foreach ($trades as $trade) {

		if( !is_null( $trade->idSeeker ) ) {
			$req = $db->prepare( "SELECT users.lastname as lastNameSeeker, users.firstname as firstNameSeeker FROM users WHERE users.id = ? ");
			$req->execute( [ $trade->idSeeker ] );
			$seeker = $req->fetch( PDO::FETCH_OBJ );

			$trades[$index]->seeker = $seeker;
		}

		$index++;
	}

	return $trades;
}

function getTradesBySeekerIdByStatus($id, $status) {
	global $db;

	$req = $db->prepare( " 	SELECT 
								trades.id as id, 
								trades.idTradeStatus as status, 
								trades.dateBegin as dateBegin, 
								trades.idSeeker as idSeeker,
								trades.dateEnd as dateEnd, 
								giver.lastname as lastNameGiver, 
								giver.firstname as firstNameGiver,
								seeker.lastname as lastNameSeeker,
								seeker.firstname as firstNameSeeker
							FROM
								trades,
								users as giver,
								users as seeker
							WHERE
								trades.idSeeker = ?
							AND
								trades.idTradeStatus = ?
							AND
								trades.idGiver = giver.id
							AND 
								trades.idSeeker = seeker.id
						" );
	$req->execute( [$id, $status] );
	$trades = $req->fetchAll(PDO::FETCH_OBJ);
	
	$index = 0;
	foreach ($trades as $trade) {
		$req = $db->prepare( "SELECT * FROM cardsintrades, cards, cardtypes WHERE cards.id = cardsintrades.idCard AND cards.idCardType = cardtypes.id AND cardsintrades.idTrade = ?");
		$req->execute( [ $trade->id ] );
		$cards = $req->fetchAll( PDO::FETCH_OBJ );

		$trades[$index]->cards = $cards;

		$index++;
	}

	return $trades;
}

function getTradesByUserIdByStatus($id, $status) {
	global $db;

	$req = $db->prepare( "	SELECT
								trades.id as id, 
								trades.idTradeStatus as status, 
								trades.dateBegin as dateBegin, 
								trades.idSeeker as idSeeker,
								trades.dateEnd as dateEnd, 
								users.lastname as lastNameGiver, 
								users.firstname as firstNameGiver
							FROM 
								trades, 
								users
							WHERE 
								trades.idGiver = ? 
							AND 
								trades.idTradeStatus = ? 
							AND
								trades.idGiver = users.id
						" );	
	$req->execute( [ $id, $status ] );
	$trades = $req->fetchAll(PDO::FETCH_OBJ);
	
	$index = 0;
	foreach ($trades as $trade) {
		$req = $db->prepare( "SELECT * FROM cardsintrades, cards, cardtypes WHERE cards.id = cardsintrades.idCard AND cards.idCardType = cardtypes.id AND cardsintrades.idTrade = ?");
		$req->execute( [ $trade->id ] );
		$cards = $req->fetchAll( PDO::FETCH_OBJ );

		if( !is_null( $trade->idSeeker ) ) {
			$req = $db->prepare( "SELECT users.lastname as lastNameSeeker, users.firstname as firstNameSeeker FROM users WHERE users.id = ? ");
			$req->execute( [ $trade->idSeeker ] );
			$seeker = $req->fetch( PDO::FETCH_OBJ );

			$trades[$index]->seeker = $seeker;
		}

		$trades[$index]->cards = $cards;

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

function updateTradeStatusById($id, $status) {
	global $db;

	$req = $db->prepare( " UPDATE trades SET status = ? WHERE id = ? " );
	$req->execute( [ $status,$id ] );
}

function updateTradeDateEndById($id, $date) {
	global $db;

	$req = $db->prepare( " UPDATE trades SET dateEnd = ? WHERE id = ? " );
	$req->execute( [ $date,$id ] );
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

function getTradeIdGiver($idTrade) {
	global $db;

	$req = $db->prepare("SELECT * FROM trades WHERE trades.id = ?");
	$req->execute( [$idTrade] );
	$trade = $req->fetch( PDO::FETCH_OBJ );

	if( !empty($trade) ) {
		return $trade->idGiver;
	} else {
		return NULL;
	}
}

function updateSeekerInTrade($idTrade, $idSeeker) {
	global $db;

	$req = $db->prepare("UPDATE trades SET idSeeker = ? WHERE id = ?");
	$req->execute( [$idSeeker, $idTrade] );
}

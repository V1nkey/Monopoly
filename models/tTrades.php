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

	return $db->lastInsertId();
}

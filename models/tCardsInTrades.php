<?php
include_once($PROJECT_ROOT . "models/database.php");

function insertIntoCardsInTrades($idCard, $idTrade) {
	global $db;

	$req = $db->prepare( "INSERT INTO cardsintrades VALUES (?,?)" );
	$req->execute( [ $idCard, $idTrade ] );
}
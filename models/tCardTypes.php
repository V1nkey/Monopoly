<?php
include_once($PROJECT_ROOT . "models/database.php");

function getAllCardTypes() {
	global $db;

	$req = $db->prepare("SELECT * FROM cardtypes ORDER BY label");
	$req->execute([]);

	return $req->fetchAll(PDO::FETCH_OBJ);
}

function existsCardType($id) {
	global $db;

	$req = $db->prepare("SELECT * FROM cardtypes WHERE id = ?");
	$req->execute( [$id] );

	return $req->rowCount();
}
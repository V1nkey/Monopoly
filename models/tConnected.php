<?php
include_once($PROJECT_ROOT . "models/database.php");

function updateConnected()
{
	global $db;
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$timestamp = time();

	$req = $db->prepare(' SELECT * FROM connected WHERE ip = ?');
	$req->execute( [$ip] );
	$n = $req->rowCount();

	// Si une entrée existe, on met à jour le timestamp, sinon, on créé une nouvelle entrée
	if( $n == 0 )
	{
		$req = $db->prepare(' INSERT INTO connected VALUES (?,?) ');
		$req->execute( [$ip, $timestamp] );
	}
	else
	{
		$req = $db->prepare(" UPDATE connected SET timestamp = ? WHERE ip = ? ");
		$req->execute( [$timestamp, $ip] );
	}

	// Suppression des ips après 5min
	$newTimestamp = time() - 5 * 60;
	$req = $db->prepare(" DELETE FROM connected WHERE timestamp < ? ");
	$req->execute( [$newTimestamp] );
}

function getNbConnected()
{
	global $db;

	$req = $db->prepare(' SELECT * FROM connected ');
	$req->execute([]);
	return $req->rowCount();
}
<?php

// Includes divers
include_once("../models/sessions.php");
include_once("../models/tUsers.php");
include_once("../models/tCards.php");
include_once("../models/tTrades.php");
include_once("../models/tCardsInTrades.php");
include_once("../models/tCardTypes.php");

$idCardType = $_POST['data'];
$response_array['status'] = 'success'; 
$response_array['message'] = 'Recherche avec succès !';

if( !is_numeric($idCardType) || !existsCardType($idCardType) ) {
	$response_array['status'] = 'error'; 
	$response_array['message'] = 'La recherche a échoué !';	
} else {
	$response_array['data'] = getTradesByCardType($idCardType);
}


header('Content-type: application/json');
echo json_encode($response_array);

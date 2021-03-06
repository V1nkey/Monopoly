<?php

// Includes divers
include_once("../models/sessions.php");
include_once("../models/tUsers.php");
include_once("../models/tCards.php");
include_once("../models/tTrades.php");
include_once("../models/tCardsInTrades.php");

$id = $_POST['data'];
$response_array['status'] = 'success'; 
$response_array['message'] = 'Récupération avec succès !';   

if( !is_numeric($id) || !existsTrade($id)  ) {
	$response_array['status'] = 'error'; 
	$response_array['message'] = 'ID non numérique ou Echange non-existant';   	
} else {
	$response_array['data'] = getCardsInTradesByTradeId($id);
}

header('Content-type: application/json');
echo json_encode($response_array);

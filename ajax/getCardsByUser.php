<?php

// Includes divers
include_once("../models/sessions.php");
include_once("../models/tCards.php");

$idUser = $_POST['data'];
$response_array['status'] = 'success'; 
$response_array['message'] = 'Recherche avec succès !';

if( !is_numeric($idUser) ) {
	$response_array['status'] = 'error'; 
	$response_array['message'] = 'La recherche a échoué !';	
} else {
	$response_array['data'] = getCardsByUserId($idUser);
}

header('Content-type: application/json');
echo json_encode($response_array);
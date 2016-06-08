<?php

// Includes divers
include_once("../models/sessions.php");
include_once("../models/tUsers.php");
include_once("../models/tCards.php");
include_once("../models/tTrades.php");
include_once("../models/tCardsInTrades.php");

$idTrade = $_POST['idTrade'];
$response_array['status'] = 'success'; 
$response_array['message'] = 'Vous avez accepté l\'échange avec succès !'; 
$response_array['data'] = $idTrade;  
 
// Vérifier :
	// - Trade existe	
	// - Trade non terminé
	// - idGiver = myId
if( !is_numeric($idTrade) || !existsTrade($idTrade) || isEnded($idTrade) || !isGiverInTrade($idTrade, $_SESSION['auth']->id ) ) {
	
	$response_array['status'] = 'error'; 
	$response_array['message'] = 'ID non numérique ou Echange non-existant';   	

} else {
	// Met à jour le statut des cartes dans l'échange
	// Met à jour le statut de l'échange
	// Met à jour la date de fin de l'échange
	// Changer le propriétaire des cartes

	updateTradeStatusById($idTrade, 5);
	$idGiver = $_SESSION['auth']->id;
	$idSeeker = getTradeIdSeeker($idTrade);
	$date = new DateTime();
	updateTradeDateEndById( $idTrade, $date->getTimestamp() );

	$cards = getCardsInTradesByTradeId($idTrade);
	foreach( $cards as $card ) {
		setCardStatusTo($card->id, 1);

		if( getCardOwnerTo($card->id) == $idGiver ) {
			setCardOwnerTo($card->id, $idSeeker);
		} else {
			setCardOwnerTo($card->id, $idGiver);
		}
	}
}

header('Content-type: application/json');
echo json_encode($response_array);

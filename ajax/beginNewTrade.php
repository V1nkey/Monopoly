<?php
// Includes divers
include_once("../models/sessions.php");
include_once("../models/tUsers.php");
include_once("../models/tCards.php");
include_once("../models/tTrades.php");
include_once("../models/tCardsInTrades.php");

$data = json_decode(stripslashes($_POST['data']));
$idTrade = json_decode(stripslashes($_POST['idTrade']));

// On fait un premier tour pour vérifier que les données sont correctes
$response_array['status'] = "success";
$response_array['message'] = "Proposition d'échange envoyée avec succès !";

foreach( $data as $id ) {
	if( !is_numeric($id) || !existsCard($id) || !isLogged() || !checkCardOWner($id, $_SESSION['auth']->id ) ) {
		$response_array['status'] = 'error'; 
		$response_array['message'] = 'Une erreur est apparue. Merci de vous reconnecter.'; 
	}
}

// Si tout va bien, on regarde aussi si le trade existe
if( $response_array['status'] == "success" ) {
	
	if( !is_numeric($id) || !existsCard($id) || !isLogged() || !checkCardOWner($id, $_SESSION['auth']->id ) ) {
		$response_array['status'] = 'error'; 
		$response_array['message'] = 'Une erreur est apparue. Merci de vous reconnecter.'; 
	} else {
		$idTrade = insertIntoTrades( $_SESSION['auth']->id );
		$response_array['message'] = "Proposition mise en ligne avec succès !";

		foreach( $data as $id ) {
			insertIntoCardsInTrades($id, $idTrade);
			setCardStatusTo($id, 2);
		}	
	}		
}


echo( json_encode($response_array) );
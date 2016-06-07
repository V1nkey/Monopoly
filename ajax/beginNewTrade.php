<?php
// Includes divers
include_once("../models/sessions.php");
include_once("../models/tUsers.php");
include_once("../models/tCards.php");
include_once("../models/tTrades.php");
include_once("../models/tCardsInTrades.php");

$cardsId = json_decode(stripslashes($_POST['data']));
$idTrade = json_decode(stripslashes($_POST['idTrade']));

// On fait un premier tour pour vérifier que les données sont correctes
$response_array['status'] = "success";
$response_array['message'] = "Proposition d'échange envoyée avec succès !";

foreach( $cardsId as $id ) {
	if( !is_numeric($id) || !existsCard($id) || !isLogged() || !checkCardOWner($id, $_SESSION['auth']->id ) ) {
		$response_array['status'] = 'error'; 
		$response_array['message'] = 'Une erreur est apparue. Merci de vous reconnecter.'; 
	}
}

// Si tout va bien, on regarde aussi si le trade existe, et si seeker <> giver 
if( $response_array['status'] == "success" ) {
	if( !is_numeric($idTrade) || !existsTrade($idTrade) || ( getTradeIdGiver($idTrade) == $_SESSION['auth']->id ) ) {
		$response_array['status'] = 'error'; 
		$response_array['message'] = 'Une erreur est apparue. Merci de vous reconnecter.'; 
	} else {
		// Si c'est ok :
		// - Mise à jour du Seeker dans le trade : OK
		// - Ajout des cartes dans le trade
		// - Mise à jour du statut du trade : OK
		// - Mise à jour du statut des cartes du giver
		// - Mise à jour du statut des cartes du seeker
		$idSeeker = $_SESSION['auth']->id;
		updateSeekerInTrade($idTrade, $idSeeker);
		updateTradeStatusById($idTrade, 1);

		foreach( $cardsId as $id ) {
			insertIntoCardsInTrades($id, $idTrade);
		}

		$cardsInTrade = getCardsInTradesByTradeId($idTrade);
		foreach( $cardsInTrade as $card ) {
			setCardStatusTo($card->id, 3);
		}
	}		
}

echo( json_encode($response_array) );
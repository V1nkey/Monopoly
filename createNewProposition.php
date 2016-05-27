<?php
// Includes divers
include_once("models/sessions.php");
include_once("models/tUsers.php");
include_once("models/tCards.php");
include_once("models/tTrades.php");
include_once("models/tCardsInTrades.php");

$data = json_decode(stripslashes($_POST['data']));

// On fait un premier tour pour vérifier que les données sont correctes
$response_array['status'] = "success";
$response_array['message'] = "Nouvelle proposition ajoutée avec succès !";

foreach( $data as $id ) {
	if( !is_numeric($id) || !existsCard($id) || !isLogged() || !checkCardOWner($id, $_SESSION['auth']->id ) ) {
		$response_array['status'] = 'error'; 
		$response_array['message'] = 'Une erreur est apparue. Merci de vous reconnecter.'; 
	}
}

// Si tout va bien, on créé une nouvelle proposition
if( $response_array['status'] == "success" ) {
	$idTrade = insertIntoTrades( $_SESSION['auth']->id );

	foreach( $data as $id ) {
		insertIntoCardsInTrades($id, $idTrade);
	}
}
<?php

include_once("../models/sessions.php");
include_once("../models/tUsers.php");

$id = $_POST["id"];
$admin = $_POST["admin"];

$response_array['status'] = "success";
$response_array['message'] = "Nouvelle proposition ajoutée avec succès !";

if( !is_numeric($id) || !isLogged() || !is_numeric($admin) || ($admin != 0 && $admin != 1)) 
{
	$response_array['status'] = 'error'; 
	$response_array['message'] = 'Une erreur est apparue. Merci de vous reconnecter.'; 
}

if( $response_array['status'] == "success" ) 
{
	updateStatus($id, $admin);
	$response_array['message'] = 'Modification enregistré.';
}

echo( json_encode($response_array) );
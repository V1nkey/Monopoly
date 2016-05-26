<?php
// Includes divers
include_once("models/sessions.php");
include_once("models/tUsers.php");
include_once("models/tCards.php");
include_once("models/tCardTypes.php");

// Normalement ce n'est pas possible, mais si l'utilisateur n'a pas envoyé d'ID de type, on le dégage
if( !$_POST['cardType'] || !is_numeric($_POST['cardType']) || !existsCardType($_POST['cardType']) )
	header('Location: account.php?err=1');
else
{
	// On regarde si l'utilisateur est quand même connecté
	if( !$_SESSION['auth']->id ) {
		header('Location: account.php?err=2');
	}

	insertCard( $_SESSION['auth']->id, $_POST['cardType'] );

	header('Location: account.php?err=0');
}
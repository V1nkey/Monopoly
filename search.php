<?php
include_once("models/sessions.php");
include_once("models/tConnected.php");
include_once("models/tCards.php");
include_once("models/tCardTypes.php");
include_once("models/tTrades.php");

updateConnected();

if(!isLogged())
{
	header('location: login.php');
	exit(0);
}

$user = getInfosByUserId( $_SESSION['auth']->id );
$trades = getTradesByUserId( $_SESSION['auth']->id );
$cardTypes = getAllCardTypes();
$cards = getCardsNotProposedByUserId( $_SESSION['auth']->id );
$page_title = "Recherche";

include_once('views/header.php');
include_once('views/topbar.php');
include_once('views/navbar-left.php');

include_once("views/search.php");

include_once('views/footer.php');
                                                                                                                                                                                                                                                                                                                                     
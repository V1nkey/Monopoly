<?php
include_once("models/sessions.php");
include_once("models/tConnected.php");
include_once("models/tCards.php");
include_once("models/tTrades.php");

updateConnected();

if(!isLogged())
{
	header('location: login.php');
	exit(0);
}

$user = getInfosUsersById($_SESSION['auth']->id);
$trades = getTradesByUserId($_SESSION['auth']->id);

$page_title = "Accueil du site";
$nbConnected = getNbConnected();
$nbCards = getNbCardsGeneral();

include_once('views/header.php');
include_once('views/topbar.php');
include_once('views/navbar-left.php');

include_once("views/index.php");

include_once('views/footer.php'); ?>
                                                                                                                                                                                                                                                                                                                                     
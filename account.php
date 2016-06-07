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

$user = getInfosByUserId($_SESSION['auth']->id);

$tradesProposed = getTradesByUserIdByStatus( $_SESSION['auth']->id,1 );
$tradesInProgressProposed = getTradesByUserIdByStatus( $_SESSION['auth']->id,2 );
$tradesInProgressJoined = getTradesBySeekerIdByStatus( $_SESSION['auth']->id, 2 );
$tradesEnded = getTradesEndedByUserId( $_SESSION['auth']->id );

$cards = getCardsByUserId($user->id);
$cardTypes = getAllCardTypes();
$page_title = "Mon Compte";

include_once('views/header.php');
include_once('views/topbar.php');
include_once('views/navbar-left.php');

include_once("views/account.php");

include_once('views/footer.php');
                                                                                                                                                                                                                                                                                                                                     
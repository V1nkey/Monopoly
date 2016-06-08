<?php
include_once("models/sessions.php");
include_once("models/tConnected.php");
include_once("models/tCards.php");
include_once("models/tTrades.php");
include_once("models/tUsers.php");

updateConnected();

if(!isLogged())
{
	header('location: login.php');
	exit(0);
}

if(!isAdmin($_SESSION["auth"]->id))
{
	header('location: index.php');
	exit(0);
}

function maximum($a, $b)
{
	if ($a > $b)
		return $a;
	else
		return $b;
}

$user = getInfosByUserId($_SESSION['auth']->id);

$tradesProposed = getTradesByUserIdByStatus( $_SESSION['auth']->id,1 );
$tradesInProgressProposed = getTradesByUserIdByStatus( $_SESSION['auth']->id,2 );
$tradesInProgressJoined = getTradesBySeekerIdByStatus( $_SESSION['auth']->id, 2 );
$tradesEnded = getTradesEndedByUserId( $_SESSION['auth']->id );

$dataUsers = getAllUsersInfos();
$dataUsers2 = getAllUsersInfos();
$dataTrades = getAllTrades();
$page_title = "Panneau d'administration";

/*echo '<pre>';
var_dump($dataTrades);
echo '</pre>';
exit(0);*/
include_once('views/header.php');
include_once('views/topbar.php');
include_once('views/navbar-left.php');

include_once("views/admin.php");

include_once('views/footer.php');
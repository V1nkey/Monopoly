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

$user = getInfosByUserId($_SESSION['auth']->id);
$trades = getTradesByUserId($_SESSION['auth']->id);
$dataUsers = getAllUsersInfos();
$dataUsers2 = getAllUsersInfos();
$dataTrades = getAllTrades();
$page_title = "Panneau d'administration";

include_once('views/header.php');
include_once('views/topbar.php');
include_once('views/navbar-left.php');

include_once("views/admin.php");

include_once('views/footer.php');
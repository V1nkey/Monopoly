<?php
	include_once("model/sessions.php");
	include_once("model/membres.php");
	include_once("model/soiree.php");

	if (!isLogged())
	{
		Header("Location: ./");
		exit(0);
	}

	else if (!isAdmin(getUserID()))
	{
		Header("Location: ./");
		exit(0);
	}
	$user = getInfosUsersById($_SESSION['session_id']);
	$historique = getFuturSoiree();
	$page_title = "Panel Admin";
	include_once("view/panel.php");

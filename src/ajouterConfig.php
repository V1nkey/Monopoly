<?php
	include_once("model/sessions.php");
	include_once("model/membres.php");
	include ("model/lieu.php");
	if (!isLogged())
		Header("Location: ./");

	else if (!isAdmin(getUserID()))
		Header("Location: ./");

	else 
	{	
		
		$page_title = "ajouterConfig";
		$user = getInfosUsersById($_SESSION['session_id']);
		$lieux = getLieuIdName();
		include_once("view/ajouterConfig.php");
	}if (!isLogged())
		Header("Location: ./");

	else if (!isAdmin(getUserID()))
		Header("Location: ./");


<?php
include_once("models/sessions.php");

if(!isLogged())
{
	header('location: login.php');
	exit(0);
}

$user = getInfosUsersById($_SESSION['auth']->id);

$page_title = "Accueil";
include_once("views/index.php");
                                                                                                                                                                                                                                                                                                                                     
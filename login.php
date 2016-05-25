<?php
include_once("models/sessions.php");
if(isLogged())
	header("Location: ./");
else
{	
	$page_title="Login";
	include_once("views/login.php");
}

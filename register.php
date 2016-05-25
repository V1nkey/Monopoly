<?php
include_once("models/sessions.php");
if(isLogged())
	Header("Location: ./");
else
{
	$page_title="Inscription";
	include_once("views/register.php");
}
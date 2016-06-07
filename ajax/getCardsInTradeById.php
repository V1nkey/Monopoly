<?php

// Includes divers
include_once("../models/sessions.php");
include_once("../models/tUsers.php");
include_once("../models/tCards.php");
include_once("../models/tTrades.php");
include_once("../models/tCardsInTrades.php");

$id = $_POST['data'];

if( !is_numeric($id) || !existsTrade($id) ) {
	
}

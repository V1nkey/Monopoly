<?php

	include_once("model/sessions.php");
	include_once("model/vote.php");


	if (!empty($_POST))

		if (!aVote(getUserID(), $_POST["idConfig"]))
			addVote($_POST["choixVote"], getUserID());

	Header('Location: soiree.php?id='.$_POST["idSoiree"]);


<?php 
include_once("model/sessions.php");
include_once("model/membres.php");
include_once("model/soiree.php");

if (!isLogged())
		Header("Location: ./");

	else if (!isAdmin(getUserID()))
		Header("Location: ./");

else if(empty($_POST["NomSoiree"]))
	header('Location: ajouterSoiree.php?err=1');
else if(empty($_POST["DateFermetureVote"]))
	header('Location: ajouterSoiree.php?err=3');
else if(empty($_POST["DateOuvertureVote"]))
	header('Location: ajouterSoiree.php?err=2');
else if(empty($_POST["DateSoiree"]))
	header('Location: ajouterSoiree.php?err=4');
else
{
		$ret = addSoiree($_POST['DateOuvertureVote'], $_POST["DateFermetureVote"], $_POST['DateSoiree'], $_POST['NomSoiree'], getUserId());
	header("Location: ajouterConfig.php?id=" . $ret);
}

<?php
include_once($PROJECT_ROOT . "model/connectBdd.php");
function getEtapes($idConfig)
{
	global $bdd;
	
	$answer = $bdd->prepare("SELECT HeureDebut, HeureFin, Etape.IdLieu, lieux.*, Etape.Type as etapeType, IdConfig FROM Etape INNER JOIN lieux ON Etape.IdLieu = lieux.idLieu WHERE IdConfig = ?");
	$data = $answer->execute(array($idConfig));
	$data = $answer->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function addEtape($heureDebut, $heureFin, $idLieu, $idConfig)
{
	global $bdd;
	
	$req = $bdd->prepare("INSERT INTO Etape (HeureDebut, HeureFin, IdLieu, IdConfig) VALUES (:heureDebut ,:heureFin, :idLieu, :idConfig)");
	$req->bindParam(':heureDebut', $heureDebut);
	$req->bindParam(':heureFin', $heureFin);
	$req->bindParam(':idLieu', $idLieu);
	$req->bindParam(':idConfig', $idConfig);
	$req->execute();
}
?>

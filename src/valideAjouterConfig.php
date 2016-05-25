<?php
	include_once("model/sessions.php");
include_once("model/membres.php");
include_once("model/etape.php");
include_once("model/config.php");


	if($_POST['submit'] == "panel")
	{
		Header('Location: panel.php');
	}
	else if(empty($_POST['idSoiree']) or empty($_POST['commentaire']))
		Header('Location: ajouterConfig.php?err=1');

	else if(!empty($_POST['HeureDebut1']) && !empty($_POST['HeureFin1']))
	{
		$ret = addConfig($_POST['idSoiree'], $_POST['commentaire']);
		
		addEtape($_POST['HeureDebut1'], $_POST['HeureFin1'], getLieuIdByName($_POST['lieu1']), $ret);

		if(!empty($_POST['HeureDebut2']) && !empty($_POST['HeureFin2']))
				addEtape($_POST['HeureDebut2'], $_POST['HeureFin2'], getLieuIdByName($_POST['lieu2']), $ret);
		if(!empty($_POST['HeureDebut3']) && !empty($_POST['HeureFin3']))
				addEtape($_POST['HeureDebut3'], $_POST['HeureFin3'], getLieuIdByName($_POST['lieu3']), $ret);
		Header('Location: ajouterConfig.php?id=' . $_GET['id']);
	}
	else
		Header('Location ajouterConfig.php?err=1&id=' . $_GET['id']);

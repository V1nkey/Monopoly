<?php
$sgbdr='mysql';
$bddHost='localhost';
$bddBase='monopoly';
$bddUser='monopoly';
$bddPassword='asinfo486';

try
{
	$db = new PDO($sgbdr . ':host=' . $bddHost . ';dbname=' . $bddBase . ';charset=utf8', $bddUser, $bddPassword);
}
catch(Exception $e)
{	
	die($e->getMessage());
}

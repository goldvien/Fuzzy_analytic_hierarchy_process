<?php
session_start();
require_once('DB.php');
require_once('models/Matrica.php');

if(isset($_SESSION['id']))
{
	if(isset($_GET['data']))
	{
		$jsonData = $_GET['data'];

		$matrica = new Matrica($jsonData);
		$matrica->setIdKorisnika($_SESSION['id']);
		$matrica->spremiUBazu();
	}
}
else
{
	die("Morate se ulogirati za pristup ovoj stranici!");
}



?>

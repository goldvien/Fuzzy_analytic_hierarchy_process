<?php
session_start();
require_once('DB.php');
require_once('models/Matrica.php');

if(isset($_SESSION['id']))
{
	if(isset($_GET['id']))
	{
		$idMatrice = $_GET['id'];

		$matrica = Matrica::dohvatiPrekoId($idMatrice);
		$matrica->brisiIzBaze();
	}
}
else
{
	die("Morate se ulogirati za pristup ovoj stranici!");
}

?>
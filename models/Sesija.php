<?php

class Sesija
{
	public static function isLoggedIn()
	{
		if(isset($_SESSION['id']))
		{
			return true;
		}
		else
		{
			die("Morate biti ulogirani kako biste pristupili ovoj stranici!");
			return false;
		}
	}

	public static function isAdmin()
	{
		if(isset($_SESSION['privilegije']))
		{
			if($_SESSION['privilegije'] === "admin") return true;
		}
		die("Morate biti ulogirani kao administrator kako biste pristupili ovoj stranici!");
		return false;
	}


	public static function setSession($id, $privilegije){
		$_SESSION['id'] = $id;
		$_SESSION['privilegije'] = $privilegije;
	}

	public static function destroySession()
	{
		session_destroy();
		unset($_SESSION['id']);
		unset($_SESSION['privilegije']);
	}
	public static function getId(){ return isset($_SESSION['id']) ? $_SESSION['id'] : null; }
	public static function getPrivilegije(){ return isset($_SESSION['privilegije']) ? $_SESSION['privilegije'] : null; }

	public static function setId($id){ $_SESSION['id'] = $id; }
	public static function setPrivilegije($privilegije){ $_SESSION['privilegije'] = $privilegije; }
}
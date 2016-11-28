<?php

class Zahtjevi
{
	public static function get($metoda, $kljucevi=[])
	{
		$rez = [];

		if($metoda == "GET")
		{
			if(isset($_GET))
			{
				foreach($kljucevi as $kljuc)
				{
					$rez[$kljuc] = isset($_GET[$kljuc]) ? $_GET[$kljuc] : null;
				}
			}
		}
		else
		{
			if(isset($_POST))
			{
				foreach ($kljucevi as $kljuc)
				{
					$rez[$kljuc] = isset($_POST[$kljuc]) ? $_POST[$kljuc] : null;
				}
			}
		}
		return $rez;
	}



	public static function set($metoda, $params=[])
	{
		if($metoda == "GET")
		{
			foreach($params as $key=>$value)
			{
				$_GET[$key] = $value;
			}
		}
		else
		{
			foreach($params as $key=>$value)
			{
				$_POST[$key] = $value;
			}
		}
	}
}
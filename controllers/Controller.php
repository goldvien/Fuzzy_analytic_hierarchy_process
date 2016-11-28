<?php

class Controller
{

	/**
	* Javna metoda za ucitavanje modela
	* @access public
	* @param string $model
	*/
	public function model($model)
	{
		require_once('../models/' . $model . '.php');
	}

	/**
	* Javna metoda za ucitavanje pogleda sa određenim podatcima
	* Podatci se salju pogledu u obliku niza.
	* @access public
	* @param string $view
	* @param array
	*/
	public function view($view, $data = [])
	{
		require_once('views/' . $view . '.php');
	}
}
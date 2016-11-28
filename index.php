<?php
session_start();
require_once('DB.php');

spl_autoload_register(function($class){
	
	if(file_exists($class . '.php'))
	{
		require_once($class . '.php');
	}
	else if(file_exists('models/' . $class . '.php')) 
	{
		require_once('models/' . $class . '.php');
	}
	else if(file_exists('controllers/' . $class . 'Controller.php'))
	{
		require_once('controllers/' . $class . 'Controller.php');
	}
});

$app = new App();
?>
<?php

class App
{
	protected $controller = 'Korisnik';
	protected $method = 'login';
	protected $params = [];

	public function App()
	{
		$url = $this->parseUrl();	
		if($url[0] == "") $url[0] = "Korisnik";
		if($url[1] == "") $url[1] = "login";

		if(file_exists('controllers/' . $url[0] . 'Controller.php'))
		{
			$this->controller = $url[0];
			unset($url[0]);
		}
		
		$this->controller = $this->controller . "Controller";
		require_once('controllers/' . $this->controller . '.php');

		$this->controller = new $this->controller;


		if(method_exists(new $this->controller, $url[1]))
		{
			$this->method = $url[1];
			if(array_key_exists(1, $url)) unset($url[1]);
		}

		$this->params = $url ? array_values($url) : [];


		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	function parseUrl()
	{
		if(isset($_GET['url']))
		{
			$url = $_GET['url'];
			$url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
			return $url;
		}
	}

}
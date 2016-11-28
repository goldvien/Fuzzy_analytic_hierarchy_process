<?php
session_start();
require_once('Controller.php');

class KorisnikController extends Controller
{
	public function index()
	{
		if(Sesija::isLoggedIn())
		{
			$title = "Korisnik pocetna";


			$this->view("korisnik/index", ['title' => $title]);
		}
	}

	public function login()
	{
		$post = Zahtjevi::get("POST", ["username", "password"]);
		$username = $post['username'];
		$password = $post['password'];

		$title 		  = "Login";
		$errorMessage = "";
		$errorStyle   = "";

		$isValid = Validacija::login($username, $password);
		if(array_key_exists("successMessage", $isValid))
		{
			$errorMessage = $isValid["successMessage"];
			$errorStyle   = $isValid["sucessStyle"];
			$korisnik     = $isValid["korisnik"];

			Sesija::setSession($korisnik->getId(), $korisnik->getPrivilegije());

			if(Sesija::getPrivilegije() === "korisnik")
			{
				header("Location: http://www.tvolaric.com/fahp/?url=Korisnik/index");	
			}
			else if(Sesija::getPrivilegije() === "admin")
			{
				header("Location: http://www.tvolaric.com/fahp/?url=Admin/index");
			}
			die();
		}
		else
		{
			$errorMessage = $isValid["errorMessage"];
			$errorStyle   = $isValid["errorStyle"];
		}


		$this->view('shared/login', ['title' 		=> $title,
									 'username' 	=> $username,
									 'password' 	=> $password,
									 'errorMessage' => $errorMessage,
									 'errorStyle'   => $errorStyle]);
	}

	public function postavkeProfila()
	{
		session_start();	
		if(Sesija::isLoggedIn())
		{
			$title    = "Postavke profila";
			$korisnik = Korisnik::dohvatiPrekoId(Sesija::getId());

			$ime          = $korisnik->getIme();
			$prezime      = $korisnik->getPrezime();
			$email        = $korisnik->getEmail();
			$username     = $korisnik->getUsername();
			$password     = $korisnik->getPassword();
			$rePassword   = "";
			$errorMessage = "";
			$erroStyle    = "";

			if(isset($_POST['btnSubmit']))
			{
				$post 		= Zahtjevi::get("POST", ["ime", "prezime", "username", "email", "password", "rePassword"]);
				$ime  	  	= $post['ime'];
				$prezime  	= $post['prezime'];
				$email 	  	= $post['email'];
				$username 	= $post['username'];
				$password 	= $post['password'];
				$rePassword = $post['rePassword'];

				$isValid = Validacija::izmjenaProfila($ime, $prezime, $email, $username, $password, $rePassword);
				if(array_key_exists("successMessage", $isValid))
				{
					$errorMessage = $isValid["successMessage"];
					$errorStyle   = $isValid["successStyle"];
					$korisnik     = $isValid["korisnik"];

					$korisnik->setEmail($email);
					$korisnik->update();
				}
				else
				{
					$errorMessage = $isValid["errorMessage"];
					$errorStyle   = $isValid["errorStyle"];
				}
			}

			$this->view("korisnik/postavkeProfila", ["title" 		=> $title, 
													 "ime"   		=> $ime,
													 "prezime" 		=> $prezime,
													 "email" 		=> $email,
													 "username" 	=> $username,
													 "password" 	=> $password,
													 "rePassword"   => $rePassword,
													 "errorMessage" => $errorMessage,
													 "errorStyle"   => $errorStyle]);
		}
	}

	public function pregledMatrica()
	{
		if(Sesija::isLoggedIn())
		{
			$title = "Pregled matrica";
			$matrice = Matrica::dohvatiSvePrekoIdKorisnika(Sesija::getId());

			$this->view('korisnik/pregledMatrica', ['title'   => $title,
													'matrice' => $matrice]);
		}
	}

	public function pregledMatrice($idMatrice)
	{
		if(Sesija::isLoggedIn())
		{
			$matrica = Matrica::dohvatiPrekoId($idMatrice);
			if($matrica->getIdKorisnika() === Sesija::getId())
			{
				$title = "Pregled matrice";

				$this->view('korisnik/pregledMatrice', ['title'   => $title,
														'matrica' => $matrica]);
			}
			else
			{
				die("Greška prilikom učitavanja matrice!");
			}
		}
	}

	public function unosMatrice()
	{
		if(Sesija::isLoggedIn())
		{
			$title = "Unos matrice";


			$this->view('korisnik/unosMatrice', ['title' => $title]);
		}
	}
}	
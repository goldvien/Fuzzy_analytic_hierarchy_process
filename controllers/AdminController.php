<?php
session_start();
require_once('Controller.php');

class AdminController extends Controller
{
	public function index()
	{
		if(Sesija::isLoggedIn())
		{
			if(Sesija::isAdmin())
			{
				$title = "Admin pocetna";

				$this->view("admin/index", ['title' => $title]);
			}
		}
	}


	public function pregledKorisnika()
	{
		if(Sesija::isLoggedIn())
		{
			if(Sesija::isAdmin())
			{
				$title 	   = "Admin - pregled korisnika";
				$korisnici = Korisnik::dohvatiSve();
				$cellStyle = "padding: 25px 25px 25px 25px;border: 1px solid black;";

				$this->view('admin/pregledKorisnika', ['title' 	   => $title,
													   'korisnici' => $korisnici,
													   'cellStyle' => $cellStyle]);
			}
		}
	}

	public function pregledKorisnikovihMatrica()
	{

	}



	public function brisiKorisnika($id)
	{
		if(Sesija::isLoggedIn())
		{
			if(Sesija::isAdmin())
			{
				$korisnik = Korisnik::dohvatiPrekoId($id);
				$korisnik->obrisi();

				header("Location: http://www.tvolaric.com/fahp/?url=Admin/pregledKorisnika");
				die();
			}
		}
	}

	public function dodajKorisnika()
	{
		if(Sesija::isLoggedIn())
		{
			if(Sesija::isAdmin())
			{
				$title 		  = "Admin - Dodaj korisnika";

				$ime          = "";
				$prezime      = "";
				$email        = "";
				$username     = "";
				$password     = "";
				$rePassword   = "";
				$privilegije  = "";
				$errorMessage = "";
				$errorStyle   = "";

				if(isset($_POST['btnSubmit']))
				{
					$post = Zahtjevi::get("POST", ["ime",
												   "prezime", 
												   "email",
												   "username",
												   "password",
												   "rePassword",
												   "privilegije"]);

					$ime          = $post['ime'];
					$prezime      = $post['prezime'];
					$email        = $post['email'];
					$username     = $post['username'];
					$password     = $post['password'];
					$rePassword   = $post['rePassword'];
					$privilegije  = $post['privilegije'];
					$errorMessage = "";
					$errorStyle   = "";

					$isValid = Validacija::unosKorisnika($ime, $prezime, $username, $email, $password, $rePassword, $privilegije);
					if(array_key_exists("successMessage", $isValid))
					{
						$errorStyle   = $isValid['successStyle'];
						$errorMessage = $isValid['successMessage'];

						$korisnik = new Korisnik($ime, $prezime, $email, $username, $password);
						$korisnik->setPrivilegije($privilegije);
						$korisnik->unesi();
					}
					else
					{
						$errorStyle   = $isValid['errorStyle'];
						$errorMessage = $isValid['errorMessage'];
					}
				}

				$this->view('admin/dodajKorisnika', ['title'    	=> $title,
													 'ime'      	=> $ime,
													 'prezime'  	=> $prezime,
													 'email'    	=> $email,
													 'username' 	=> $username,
													 'password' 	=> $password,
													 'privilegije'  => $privilegije,
													 'errorMessage' => $errorMessage,
													 'errorStyle'   => $errorStyle
													 ]);
			}
		}
	}
}
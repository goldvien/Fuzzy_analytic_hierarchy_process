<?php

class Validacija
{
	public static function login($username, $password)
	{
		if($username)
		{
			if($password)
			{
				$korisnik = Korisnik::logiraj($username, $password);
				if($korisnik)
				{
					$successMessage = "Uspjesno ste ulogirani!";
					$successStyle   = "color: green;";
					return array("successMessage" => $successMessage, "successStyle" => $successStyle, "korisnik" => $korisnik);
				}
				else
				{
					$errorMessage = "Greska prilikom logiranja!";
					$errorStyle   = "color: red;";
					return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
				}
			}
			else
			{
				$errorMessage = "Unesite password!";
				$errorStyle   = "color: red;";
				return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
			}
		}
		else
		{
			$errorMessage     = "Unesite korisničko ime!";
			$errorStyle       = "color: red;";
			return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
		}
	}

	public static function izmjenaProfila($ime, $prezime, $email, $username, $password, $rePassword)
	{
		if($ime)
		{
			if($prezime)
			{
				if($email)
				{
					if($username)
					{
						if($password)
						{
							if($rePassword)
							{
								if($password === $rePassword)
								{
									$korisnici = Korisnik::dohvatiSvePrekoEmail($email);
									$isOk = true;
									foreach($korisnici as $korisnik)
									{
										if(($korisnik->getEmail() === $email) && ($korisnik->getId() != Sesija::getId()))
										{
											$isOk = false;
											break;
										}
									}
									if($isOk)
									{
										$korisnici = Korisnik::dohvatiSvePrekoUsername($username);
										$isOk = true;
										foreach($korisnici as $korisnik)
										{
											if(($korisnik->getUsername() === $username) && ($korisnik->getId() != Sesija::getId()))
											{
												$isOk = false;
												break;
											}
										}
										if($isOk)
										{
											$korisnik = Korisnik::dohvatiPrekoId(Sesija::getId());

											$successMessage = "Izmjene usjpešno spremljene!";
											$sucessStyle = "color: green;";
											return array("successMessage" => $successMessage,
														 "successStyle"   => $successStyle,
														 "korisnik"       => $korisnik);
										}
										else
										{
											$errorMessage = "Korisničko ime je zauzeto!";
											$errorStyle   = "color: red;";
											return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
										}
									}
									else
									{
										$errorMessage = "E-mail je zauzet!";
										$errorStyle   = "color: red;";
										return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
									}
								}
								else
								{
									$errorMessage = "Passwordi se ne podudaraju!";
									$errorStyle   = "color: red;";
									return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
								}
							}
							else
							{
								$errorMessage = "Ponovite password!";
								$errorStyle   = "color: red;";
								return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
							}
						}
						else
						{
							$errorMessage = "Unesite password!";
							$errorStyle   = "color: red;";
							return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
						}
					}
					else
					{
						$errorMessage = "Unesite korisničko ime!";
						$errorStyle   = "color: red;";
						return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
					}
				}
				else
				{
					$errorMessage = "Unesite email!";
					$errorStyle   = "color: red;";
					return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
				}
			}
			else
			{
				$errorMessage = "Unesite prezime!";
				$errorStyle   = "color: red;";
				return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
			}
		}
		else
		{
			$errorMessage = "Unesite ime!";
			$errorStyle   = "color: red;";
			return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
		}
	}
	
	public static function unosKorisnika($ime, $prezime, $email, $username, $password, $rePassword, $privilegije)
	{
		if($ime)
		{
			if($prezime)
			{
				if($email)
				{
					if($username)
					{
						if($password)
						{
							if($rePassword)
							{
								if($password === $rePassword)
								{
									if($privilegije)
									{
										$korisnici = Korisnik::dohvatiSvePrekoUsername($username);
										if(count($korisnici) <= 0)
										{
											$korisnici = Korisnik::dohvatiSvePrekoEmail($email);
											if(count($korisnici) <= 0)
											{
												$successMessage = "Uspjesno ste unijeli korisnika!";
												$successStyle = "color: green;";
												return array("successMessage" => $successMessage, "successStyle" => $successStyle);
											}
											else
											{
												$errorMessage = "Email je zauzet!";
												$errorStyle = "color: red;";
												return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
											}
										}
										else
										{
											$errorMessage = "Korisničko ime je zauzeto!";
											$errorStyle = "color: red;";
											return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
										}
									}
									else
									{
										$errorMessage = "Unesite privilegije korisnika!";
										$errorStyle = "color: red;";
										return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
									}
								}	
								else
								{
									$errorMessage = "Passwordi se ne podudaraju!";
									$errorStyle = "color: red;";
									return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
								}
							}
							else
							{
								$errorMessage = "Unesite ponovljeni password!";
								$errorStyle = "color: red;";
								return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
							}
						}
						else
						{
							$errorMessage = "Unesite password!";
							$errorStyle = "color: red;";
							return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
						}
					}
					else
					{
						$errorMessage = "Unesite korisničko ime!";
						$errorStyle = "color: red;";
						return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
					}
				}
				else
				{
					$errorMessage = "Unesite email!";
					$errorStyle = "color: red;";
					return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
				}
			}
			else
			{
				$errorMessage = "Unesite prezime!";
				$errorStyle = "color: red;";
				return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
			}
		}
		else
		{
			$errorMessage = "Unesite ime!";
			$errorStyle = "color: red;";
			return array("errorMessage" => $errorMessage, "errorStyle" => $errorStyle);
		}
	}
}
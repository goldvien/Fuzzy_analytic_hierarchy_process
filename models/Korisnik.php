<?php


class Korisnik
{
	private $id;
	private $ime;
	private $prezime;
	private $email;
	private $username;
	private $password;
	private $privilegije;

	public function Korisnik($ime,$prezime,$email,$username,$password)
	{
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->email = $email;
		$this->username = $username;
		$this->password = $password;
	}

	public function update()
	{
		$db = new DB();
		$db->Query("UPDATE fahp_korisnici SET ime=?, prezime=?, email=?, username=?, password=?, privilegije=? WHERE id=?",
			[$this->ime, $this->prezime, $this->email, $this->username, $this->password,$this->privilegije, $this->id]);
	}

	public function unesi()
	{
		$db = new DB();
		$db->Query("INSERT INTO fahp_korisnici(ime,prezime,email,username,password,privilegije) VALUES(?,?,?,?,?,?)",
			[$this->ime, $this->prezime, $this->email, $this->username, $this->password, $this->privilegije]);
	}

	public function obrisi()
	{
		$db = new DB();
		$db->Query("DELETE FROM fahp_korisnici WHERE id=?", [$this->id]);
	}

	public static function logiraj($username, $password)
	{
		$db = new DB();
		$db->Query("SELECT * FROM fahp_korisnici WHERE username=? AND password=?", [$username, $password]);

		$korisnik = null;
		if($db->getResult())
		{
			$r = $db->getResult()[0];
			$korisnik = new Korisnik($r['ime'], $r['prezime'], $r['email'], $r['username'], $r['password']);
			$korisnik->setId($r['id']);
			$korisnik->setPrivilegije($r['privilegije']);
		}
		return $korisnik;
	}

	public static function dohvatiPrekoId($id)
	{
		$db = new DB();
		$db->Query("SELECT * FROM fahp_korisnici WHERE id=?", [$id]);

		$korisnik = null;
		if($db->getResult())
		{
			$r = $db->getResult()[0];
			$korisnik = new Korisnik($r['ime'], $r['prezime'], $r['email'], $r['username'], $r['password']);
			$korisnik->setId($r['id']);
			$korisnik->setPrivilegije($r['privilegije']);
		}
		return $korisnik;
	}


	public static function dohvatiSvePrekoEmail($email)
	{
		$db = new DB();
		$db->Query("SELECT * FROM fahp_korisnici WHERE email=?", [$email]);

		$korisnici = [];
		foreach($db->getResult() as $r)
		{
			$korisnik = new Korisnik($r['ime'], $r['prezime'], $r['email'], $r['username'], $r['password']);
			$korisnik->setId($r['id']);
			$korisnik->setPrivilegije($r['privilegije']);
			array_push($korisnici, $korisnik);
		}
		return $korisnici;
	}

	public static function dohvatiSvePrekoUsername($username)
	{
		$db = new DB();
		$db->Query("SELECT * FROM fahp_korisnici WHERE username=?", [$username]);

		$korisnici = [];
		foreach($db->getResult() as $r)
		{
			$korisnik = new Korisnik($r['ime'], $r['prezime'], $r['email'], $r['username'], $r['password']);
			$korisnik->setId($r['id']);
			$korisnik->setPrivilegije($r['privilegije']);
			array_push($korisnici, $korisnik);
		}
		return $korisnici;
	}

	public static function dohvatiSve()
	{
		$db = new DB();
		$db->Query("SELECT * FROM fahp_korisnici",[]);

		$korisnici = [];
		foreach($db->getResult() as $r)
		{
			$korisnik = new Korisnik($r['ime'], $r['prezime'], $r['email'], $r['username'], $r['password']);
			$korisnik->setId($r['id']);
			$korisnik->setPrivilegije($r['privilegije']);
			array_push($korisnici, $korisnik);
		}
		return $korisnici;
	}


	public function  getId(){ return $this->id; }
	public function  getIme(){ return $this->ime; }
	public function  getPrezime(){ return $this->prezime; }
	public function  getEmail(){ return $this->email; }
	public function  getUsername(){ return $this->username; }
	public function  getPassword(){ return $this->password; }
	public function  getPrivilegije(){ return $this->privilegije; }

	public function  setId($id){ $this->id = $id; }
	public function  setIme($ime){ $this->ime = $ime; }
	public function  setPrezime($prezime){ $this->prezime = $prezime; }
	public function  setEmail($email){ $this->email = $email; }
	public function  setUsername($username){ $this->username = $username; }
	public function  setPassword($password){ $this->password = $password; }
	public function  setPrivilegije($privilegije){ $this->privilegije = $privilegije; }
}
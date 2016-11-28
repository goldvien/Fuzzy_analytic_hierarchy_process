<?php


class Matrica
{
	private $id;
	private $brojKriterija;
	private $kriteriji;
	private $vrijednosti;
	private $json;
	private $id_korisnika;
	private $cilj;
	private $datumKreiranjaMatrice;

	public function Matrica($json)
	{
		$this->id_korisnika = 0;
		$this->id = 0;
		$this->json = $json;
		$this->kriteriji = [];
		$this->vrijednosti = array(array());

		$this->parse();
	}

	public function parse()
	{
		$parsedJson = json_decode($this->json);
		
		foreach($parsedJson as $key=>$val){
			foreach($val as $k=>$v){
				$this->vrijednosti[$key][$k] = $v;

			}
		}	
	$this->cilj = $this->vrijednosti[0][0];
	if(!$this->cilj) $this->cilj = "";
	}

	public function toString()
	{
		$str = "";
		foreach($this->vrijednosti as $key=>$val){
			foreach($val as $k=>$v){
				$str .= "m[$key][$k] = $v</br>";
			}
		}
		return $str;
	}

	public function spremiUBazu()
	{
		$db = new DB();
		$db->Query("INSERT INTO fahp_matrica(id_korisnika, matrica_json, cilj, datum_kreiranja) VALUES(?,?,?, NOW())", [$this->id_korisnika, $this->json, $this->cilj]);
	}

	public function nacrtaj()
	{
		echo "<table border='1'>";
		for($i=0; $i<count($this->vrijednosti); $i++)
		{
			echo "<tr>";
			for($j=0; $j<count($this->vrijednosti[$i]); $j++)
			{
				echo "<td style='padding: 15px 15px 15px 15px;'>";
					echo $this->vrijednosti[$i][$j];
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}

	public function brisiIzBaze()
	{
		$db = new DB();
		$db->Query("DELETE FROM fahp_matrica WHERE id=?", [$this->id]);
	}

	public static function dohvatiPrekoId($id)
	{
		$db = new DB();
		$db->Query("SELECT * FROM fahp_matrica WHERE id=?", [$id]);

		if($db->getResult())
		{
			$r = $db->getResult()[0];
			$rez = new Matrica($r['matrica_json']);
			$rez->setDatumKreiranja($r['datum_kreiranja']);
			$rez->setIdKorisnika($r['id_korisnika']);
			$rez->setCilj($r['cilj']);
			$rez->setId($r['id']);
			return $rez;
		}
	}

	public static function dohvatiSvePrekoIdKorisnika($id_korisnika)
	{
		$db = new DB();
		$db->Query("SELECT * FROM fahp_matrica WHERE id_korisnika=?", [$id_korisnika]);

		$matrice = [];
		foreach($db->getResult() as $r)
		{
			$rez = new Matrica($r['matrica_json']);
			$rez->setDatumKreiranja($r['datum_kreiranja']);
			$rez->setIdKorisnika($r['id_korisnika']);
			$rez->setCilj($r['cilj']);
			$rez->setId($r['id']);
			array_push($matrice, $rez);
		}
		return $matrice;
	}

	public function setId($id){ $this->id = $id; }
	public function getId(){ return $this->id; }
 
	public function setCilj($cilj){ $this->cilj = $cilj; }
	public function getCilj(){ return $this->cilj; }

	public function setDatumKreiranja($datum_kreiranja)
	{
		$this->datum_kreiranja = $datum_kreiranja;
	}
	public function getDatumKreiranja(){ return $this->datum_kreiranja; }

	public function getVrijednosti()
	{
		return $this->vrijednosti;
	}
	public function getElement($i,$j)
	{
		return $this->vrijednosti[$i][$j];
	}

	public function getKriterije()
	{
		return $this->kriteriji;
	}

	public function setIdKorisnika($id_korisnika)
	{
		$this->id_korisnika = $id_korisnika;
	}

	public function getIdKorisnika()
	{
		return $this->id_korisnika;
	}

	public function getJSON()
	{
		return $this->json;
	}
}
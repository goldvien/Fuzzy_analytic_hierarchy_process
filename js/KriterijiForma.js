function Kriterij(idTablice,brojRetka)
{
	let self = this;
	this.brojRetka = brojRetka-1;
	this.tablica   = document.getElementById(idTablice);
	this.redak     = this.tablica.insertRow(this.brojRetka);
	this.redak.id  = idTablice + "Redak" + this.brojRetka;

	this.redniBrojCelija = this.redak.insertCell(0);
	this.kriterijInputTxtCelija = this.redak.insertCell(1);
	this.ukloniKriterijBtnCelija = this.redak.insertCell(2);


	this.redniBrojDiv = document.createElement("div");
	this.kriterijInputTxt = document.createElement("input");
	this.ukloniKriterijBtn = document.createElement("button");

	this.redniBrojDiv.id = "redniBrojKriterij" + this.brojRetka; 
	this.redniBrojDiv.innerHTML = "Kriterij " + this.brojRetka;
	this.redniBrojDiv.name = "redniBrojKriterij" + this.brojRetka;

	this.kriterijInputTxt.id = "kriterijInputTxt" + this.brojRetka;
	this.kriterijInputTxt.name = "kriterijInputTxt" + this.brojRetka;
	this.kriterijInputTxt.type = "text";
	this.kriterijInputTxt.value = "";

	this.ukloniKriterijBtn.type = "button";
	this.ukloniKriterijBtn.name = "ukloniKriterijBtn" + this.brojRetka;
	this.ukloniKriterijBtn.innerHTML = "Ukloni kriterij";
	this.ukloniKriterijBtn.id = "ukloniKriterijBtn" + this.brojRetka;

	this.redniBrojCelija.appendChild(this.redniBrojDiv);
	this.kriterijInputTxtCelija.appendChild(this.kriterijInputTxt);
	this.ukloniKriterijBtnCelija.appendChild(this.ukloniKriterijBtn);

	this.setRedniBrojDivTxt = function(text)
	{
		this.redniBrojDiv.innerHTML = text;
	}
}

function KriterijiForma(id)
{
	let self = this;
	this.id = id;
	this.brojKriterija = 1;
	this.kriteriji = [];
	this.tablica = document.createElement("table");
	this.forma = document.createElement("form");
	this.tablica.id = this.id + "Tablica";
	this.forma.id = this.id;
	this.forma.appendChild(this.tablica);

	this.dodajKriterijBtn = document.createElement("button");
	this.dodajKriterijBtn.id = "dodajKriterijBtn";
	this.dodajKriterijBtn.type = "button";
	this.dodajKriterijBtn.innerHTML = "Dodaj kriterij";
	this.dodajKriterijBtnRedak = this.tablica.insertRow(0);
	this.dodajKriterijBtnCelija = this.dodajKriterijBtnRedak.insertCell(0);
	this.dodajKriterijBtnCelija.appendChild(this.dodajKriterijBtn);
	this.dodajKriterijBtn.onclick = function(){ self.dodajKriterij(); };

	this.getKriterije = function()
	{
		var kriteriji = [];
		for(var i=0; i<this.kriteriji.length; i++)
		{
			kriteriji.push(this.kriteriji[i].kriterijInputTxt.value);
		}
		return kriteriji;
	}

	this.dodajKriterij = function()
	{
		var kriterij = new Kriterij(this.tablica.id, this.brojKriterija);
		kriterij.ukloniKriterijBtn.onclick = function()
		{
			self.brisiKriterij(this);
		}
		this.kriteriji.push(kriterij);
		this.brojKriterija++;
		this.updateRedneBrojeveKriterija();
	}

	this.izbaciKriterijIzListe = function(el)
	{
		for(var i=0; i<this.kriteriji.length; i++)
		{
			if(this.kriteriji[i].redak.id == el.parentNode.parentNode.id)
			{
				var index = this.kriteriji.indexOf(this.kriteriji[i]);
				if(index > -1)
				{
					this.kriteriji.splice(index, 1);	
				}
			}
		}
	}

	this.brisiKriterij = function(el)
	{
		el.parentNode.parentNode.parentNode.removeChild(el.parentNode.parentNode);
		this.izbaciKriterijIzListe(el);
		this.brojKriterija--;
		this.updateRedneBrojeveKriterija();
	}



	this.updateRedneBrojeveKriterija = function()
	{
		for(var i=0; i<self.kriteriji.length; i++)
		{
			this.kriteriji[i].setRedniBrojDivTxt("Kriterij " + (i+1));
		}
	}
}
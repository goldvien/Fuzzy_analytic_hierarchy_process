function MySelect(id,opcije)
{
	let self = this;
	this.id = id;
	this.opcije = opcije;
	this.select = document.createElement("select");
	this.select.id = this.id;

	for(var i=0; i<this.opcije.length; i++)
	{
		var opcija = document.createElement("option");
		opcija.value = i;
		opcija.innerHTML = this.opcije[i];
		this.select.appendChild(opcija);
	}
}

function Odnos(idTablice, brojRetka, kriterij1, kriterij2)
{
	self = this;
	this.brojRetka = brojRetka-1;
	this.kriterij1 = kriterij1;
	this.kriterij2 = kriterij2;
	this.tablica   = document.getElementById(idTablice);
	this.redak     = this.tablica.insertRow(this.brojRetka);
	this.redak.id  = idTablice + "Redak" + this.brojRetka;

	this.odnosTxtDivCelija = this.redak.insertCell(0);
	this.odnosSelectCelija = this.redak.insertCell(1);

	this.odnosTxtDiv = document.createElement("div");
	this.odnosSelect = new MySelect("MySelect" + this.brojRetka, [TrokutniFuzzyBrojEnum.U_potpunosti_jednako.toString,
																  TrokutniFuzzyBrojEnum.Jednako_važno.toString,
																  TrokutniFuzzyBrojEnum.Umjereno_važnije.toString,
																  TrokutniFuzzyBrojEnum.Dosta_važnije.toString,
																  TrokutniFuzzyBrojEnum.Jako_važnije.toString,
																  TrokutniFuzzyBrojEnum.Izrazito_važnije.toString]);
	this.odnosTxtDiv.id   = "odnosTxtDiv" + this.brojRetka;
	this.odnosTxtDiv.name = "odnosTxtDiv" + this.brojRetka;

	this.odnosTxtDivCelija.appendChild(this.odnosTxtDiv);
	this.odnosSelectCelija.appendChild(this.odnosSelect.select);

	this.setOdnosTxt = function(text)
	{
		this.odnosTxtDiv.innerHTML = text;
	}
}

function SpremljeniOdnos(k1,k2,odabir)
{
	let self = this;
	this.k1 = k1;
	this.k2 = k2;
	this.odabir = odabir;
}

function OdnosiForma(id)
{
	let self = this;
	this.brojOdnosa = 1;
	this.kriteriji = [];
	this.odnosi = [];
	this.spremljeniOdnosi = [];
	this.tablica = document.createElement("table");
	this.tablica.id = id + "Tablica";
	this.forma = document.createElement("form");
	this.tablica.id = id + "Tablica";
	this.forma.id = id;
	this.forma.appendChild(this.tablica);


	this.setKriteriji = function(kriteriji)
	{
		this.kriteriji = kriteriji;
		this.update();
	}

	this.update = function()
	{
		this.brisiOdnose();
		for(var i=0; i<this.kriteriji.length; i++)
		{
			for(var j=i+1; j<this.kriteriji.length; j++)
			{
				var isCached = false;
				var odabir = 1;
				for(var k=0; k<this.spremljeniOdnosi.length; k++)
				{
					if(this.spremljeniOdnosi[k].k1 == this.kriteriji[i] && this.spremljeniOdnosi[k].k2 == this.kriteriji[j])
					{
						isCached = true;
						odabir = this.spremljeniOdnosi[k].odabir;
						break;
					}
				}
				if(isCached == true)
				{
					this.dodajOdnos(this.kriteriji[i], this.kriteriji[j], odabir);
				}
				else
				{
					this.dodajOdnos(this.kriteriji[i], this.kriteriji[j], 0);	
				}
			}
		}
	}

	this.brisiOdnose = function()
	{
		for(var i=0; i<this.odnosi.length; i++)
		{
			this.odnosi[i].odnosTxtDiv.parentNode.parentNode.parentNode.removeChild(this.odnosi[i].odnosTxtDiv.parentNode.parentNode);
			this.brojOdnosa--;
		}
		this.odnosi = [];
	}

	this.dodajOdnos = function(k1,k2,odabir)
	{
		var odnos = new Odnos(this.tablica.id, this.brojOdnosa, k1, k2);
		odnos.setOdnosTxt("<strong style='color: red;'>" + k1 + "</strong> se odnosi prema <strong style='color: red;'>" + k2 + "</strong>");
		odnos.odnosSelect.select.value = odabir;
		this.odnosi.push(odnos);
		this.brojOdnosa++;
	}

	this.dohvatiIndexKriterija = function(kriterij)
	{
		var index = -1;
		for(var i=0; i<this.kriteriji.length; i++)
		{
			if(kriterij == this.kriteriji[i]) index = i;
		}
		return index;
	}

	this.dodajSpremljeniOdnos = function(spremljeniOdnos)
	{
		if(spremljeniOdnos.k1 == "" || spremljeniOdnos.k2 == "") return;

		var isFound = false;
		for(var i=0; i<this.spremljeniOdnosi.length; i++)
		{
			if(spremljeniOdnos.k1 == this.spremljeniOdnosi[i].k1 && spremljeniOdnos.k2 == this.spremljeniOdnosi[i].k2)
			{
				isFound = true;
			}
		}
		if(isFound == true)
		{
			this.spremljeniOdnosi[i] = spremljeniOdnos;
		}
		else
		{
			this.spremljeniOdnosi.push(spremljeniOdnos);
		}
	}

	this.izbaciOdnosIzListe = function()
	{

	}

	this.brisiOdnos = function()
	{

		this.brojOdnosa--;
	}
}


function Matrica(id,kriteriji)
{
	let self = this;
	this.kriteriji = kriteriji;
	this.vrijednosti = {};
	this.forJson = {};
	for(var i=0; i<this.kriteriji.length; i++)
	{
		this.vrijednosti[i] = {};
		this.forJson[i] = {};
	}
	
	this.tablica = document.createElement("table");
	this.tablica.id = id;
	this.tablica.style.border = "1px solid black";

	this.setKriteriji = function(kriteriji)
	{
		this.kriteriji = kriteriji;
		this.update();
	}

	this.setVrijednost = function(i,j,vrijednost)
	{
		this.vrijednosti[i][j].innerHTML = vrijednost;
		this.forJson[i][j] = vrijednost;
	}

	this.toJson = function()
	{
		return JSON.stringify(this.forJson);
	}

	this.fromJson = function(json)
	{
		this.vrijednosti = JSON.parse(json);
		this.forJson = JSON.parse(json);

		this.kriteriji = [];
		$("#" + this.tablica.id + " tr").remove();

		for(var key in this.forJson)
		{
			var redak = this.tablica.insertRow(key);
			for(var k in this.forJson[key])
			{
				//console.log("m["+key+"]["+k+"] = " + this.forJson[key][k]);
				if(k == 0 || key == 0) this.kriteriji.push(this.forJson[key][k]);
				var celija = redak.insertCell(k);
				celija.innerHTML = this.forJson[key][k];
				celija.style.border = "1px solid black";
				celija.style.padding = "10px 10px 10px 10px";
			}
		}
	}

	this.ukloniKriterij = function(indexKriterija)
	{
		for(var i=0; i<this.kriteriji.length; i++)
		{
			if(i == indexKriterija)
			{
				this.kriteriji.splice(indexKriterija, 1);
			}
		}
	}

	this.update = function()
	{
		$("#" + this.tablica.id + " tr").remove(); 
		for(var i=0; i<this.kriteriji.length+1; i++)
		{
			var redak = this.tablica.insertRow(i);
			this.vrijednosti[i] = {};
			this.forJson[i] = {};
			for(var j=0; j<this.kriteriji.length+1; j++)
			{
				var celija = redak.insertCell(j);
				celija.style.border = "1px solid black";
				celija.style.padding = "10px 10px 10px 10px";
				this.vrijednosti[i][j] = celija;
				
				if(i==0 && j==0)
				{
				}
				else if(i == 0)
				{
					celija.innerHTML = this.kriteriji[j-1];
				}
				else if(i!=0 && j!=0)
				{
					celija.innerHTML = TrokutniFuzzyBrojEnum.U_potpunosti_jednako.vrijednost.toString();
				}

				if(i == 0 && j == 0)
				{

				}
				else if(j == 0)
				{
					celija.innerHTML = this.kriteriji[i-1];
				}

				if(i == j && (i != 0 && j != 0))
				{
					celija.innerHTML = TrokutniFuzzyBrojEnum.U_potpunosti_jednako.vrijednost.toString();
				}
				this.forJson[i][j] = this.vrijednosti[i][j].innerHTML;
			}	
		}
	}

	this.toTable = function()
	{
		return this.tablica;
	}
}
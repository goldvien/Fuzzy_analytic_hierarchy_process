<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $data ['title'] ?></title><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="http://tvolaric.com/fahp/js/TrokutniFuzzyBroj.js"></script>
		<script src="http://tvolaric.com/fahp/js/KriterijiForma.js"></script>
		<script src="http://tvolaric.com/fahp/js/OdnosiForma.js"></script>
		<script src="http://tvolaric.com/fahp/js/Matrica.js"></script>
	</head>

	<body>
		<div style="visibility: hidden;" id="matricaJSON" name="matricaJSON">
			<?php echo $data['matrica']->getJSON(); ?>
		</div>
		<div id="glavniContainer" class="container">

		</div>
	</body>
			<script type="text/javascript">
			function kreirajLegendu()
			{
				var legendaDiv = document.createElement("div");

				legendaDiv.id = "legendaDiv";
				legendaDiv.style.display = "none";
				legendaDiv.innerHTML = ""
		+ "<div class='row'><div class='col-2-sm'><div class='col-8-sm'><div class='col-2-sm'><pre><strong>"
 +"U potpunosti jednako - Dvije osobine imaju jednak doprinos </br>"
 +"Jednako važno        - Jedna  osobina je važnija od druge </br>"
+ "Umjereno važnije     - Jedna osobina je umjereno važnija od druge </br>"
+ "Dosta važnije        - Jedna osobina je značajno važnija od druge </br>"
+ "Jako važnije         - Jedna osobina je dominantna u odnosu na drugu </br>"
 + "Izrazito važnije     - Jedna osobina po važnosti u potpunosti nadmašuje drugu, koja se može zanemariti </br>"
	+	"</strong></pre></div></div></div></div>";

	return legendaDiv;
			}

			var kriterijiForma1 = new KriterijiForma("kriterijiForma1");
			var odnosiForma1 = new OdnosiForma("odnosiForma1");
			var matrica = new Matrica("matrica1", []);
			matrica.fromJson(document.getElementById("matricaJSON").innerHTML)
			kriterijiForma1.kriteriji = matrica.kriteriji;
			var legendaDiv = kreirajLegendu();
			var ciljMatriceInputTxt = document.createElement("input");
			ciljMatriceInputTxt.name = "ciljMatriceInputTxt";
			ciljMatriceInputTxt.id   = "ciljMatriceInputTxt";

		    var btnSpremiMatricu = document.createElement("button");
		    btnSpremiMatricu.type = "button";
		    btnSpremiMatricu.innerHTML = "Spremi";
		    btnSpremiMatricu.id = "btnSpremiMatricu";
		    btnSpremiMatricu.name = "btnSpremiMatricu";
		    btnSpremiMatricu.onclick = function()
		    {
		    	if(confirm("Jeste li sigurni da želite spremiti matricu u bazu?"))
		    	{
		    		matrica.setVrijednost(0,0, ciljMatriceInputTxt.value);
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
					xhttp.responseText // return from your php;
					}
					};
					xhttp.open("GET", "http://www.tvolaric.com/fahp/spremiMatricuUBazu.php?data="+matrica.toJson(), true);
					xhttp.send();
		    	}
		    }

		    var bootstrap_row = document.createElement("div");
		    bootstrap_row.className = "row";

		    var bootstrap_col1 = document.createElement("div");
		    var bootstrap_col2 = document.createElement("div");
		    var bootstrap_col3 = document.createElement("div");
		    bootstrap_col1.className = "col-sm-2";
		    bootstrap_col2.className = "col-sm-8";
		    bootstrap_col3.className = "col-sm-2";

		    bootstrap_row.appendChild(bootstrap_col1);
		    bootstrap_row.appendChild(bootstrap_col2);
		    bootstrap_row.appendChild(bootstrap_col3);

		    var row1 = bootstrap_row.cloneNode(true);
		    var ciljMatriceDiv = document.createElement("div");
		    ciljMatriceDiv.innerHTML = "Cilj matrice: ";
		    row1.childNodes[1].appendChild(ciljMatriceDiv);
		    row1.childNodes[1].appendChild(ciljMatriceInputTxt);
		    row1.childNodes[1].appendChild(kriterijiForma1.forma);
		    document.getElementsByTagName('body')[0].appendChild(row1);

		    var row2 = bootstrap_row.cloneNode(true);
		    row2.childNodes[1].appendChild(document.createElement("hr"));
		    document.getElementsByTagName('body')[0].appendChild(row2);

			var row3 = bootstrap_row.cloneNode(true);
			row3.childNodes[1].appendChild(legendaDiv);
			row3.childNodes[1].appendChild(odnosiForma1.forma);
			row3.childNodes[1].appendChild(document.createElement("hr"));
			document.getElementsByTagName('body')[0].appendChild(row3);

		    var row4 = bootstrap_row.cloneNode(true);
		    row4.childNodes[1].appendChild(matrica.tablica);
		    row4.childNodes[1].appendChild(document.createElement("hr"));
		    document.getElementsByTagName('body')[0].appendChild(row4);

		    var row5 = bootstrap_row.cloneNode(true);
		    row5.childNodes[1].appendChild(btnSpremiMatricu);
		    document.getElementsByTagName('body')[0].appendChild(row5);

				
		$(document).ready(function(){
			$(document).on('input', 'input', function(){
				var kriteriji = kriterijiForma1.getKriterije();
				odnosiForma1.setKriteriji(kriteriji);
				matrica.setKriteriji(kriteriji);
			});

			$("#" + kriterijiForma1.dodajKriterijBtn.id).click(function(){
				var kriteriji = kriterijiForma1.getKriterije();
				if(kriteriji.length > 0) legendaDiv.style.display = "block";
				odnosiForma1.setKriteriji(kriteriji);

			var didRemove = false;
			for(var i=0; i<kriterijiForma1.kriteriji.length; i++)
			{
				$("#" + kriterijiForma1.kriteriji[i].ukloniKriterijBtn.id).click(function(){
				var ukloniKriterijBtn = document.getElementById(this.id);
				kriteriji = kriterijiForma1.getKriterije();
				if(kriteriji.length <= 0) legendaDiv.style.display = "none";
				var indexKriterija = parseInt(this.id.replace("ukloniKriterijBtn", ""));
				kriteriji = kriteriji.splice(indexKriterija, 1);
				matrica.ukloniKriterij(indexKriterija);
				matrica.update();
				var kriterijTxt = kriteriji[i];
				if(indexKriterija > -1 && didRemove == false)
				{
					kriteriji.splice(indexKriterija,1);
					for(var y=0; y<odnosiForma1.spremljeniOdnosi.length; y++)
					{
						if(odnosiForma1.spremljeniOdnosi[y].k1 == kriterijTxt || odnosiForma1.spremljeniOdnosi[y].k2 == kriterijTxt)
						{
							odnosiForma1.spremljeniOdnosi.splice(y, 1);
						}
					}
					didRemove = true;
				}

					odnosiForma1.setKriteriji(kriteriji);
				});
			}
			});

			$(document).on('change', 'select', function()
			{
				dodajSpremljeniOdnos(this);
			});
		});

		function dodajSpremljeniOdnos(el)
		{
			var redak = document.getElementById(el.id).parentNode.parentNode;
			var odnosTxt = redak.firstChild.firstChild.innerHTML;
			var odnosTxtArray = odnosTxt.split(" se odnosi prema ");
			var k1 = odnosTxtArray[0].replace("<strong style=\"color: red;\">", "");
			k1 = k1.replace("</strong>", "");
			var k2 = odnosTxtArray[1].replace("<strong style=\"color: red;\">", "");
			k2 = k2.replace("</strong>", "");

			var k1Index = odnosiForma1.dohvatiIndexKriterija(k1);
			var k2Index = odnosiForma1.dohvatiIndexKriterija(k2);

			el.id = "MySelect" + k1Index + "_" + k2Index;
			var odabir = el.value;
			var spremljeniOdnos = new SpremljeniOdnos(k1,k2,odabir);
			matrica.setVrijednost(k1Index+1, k2Index+1, TrokutniFuzzyBrojEnumDict[odabir].vrijednost.toString());
			matrica.setVrijednost(k2Index+1, k1Index+1, TrokutniFuzzyBrojEnumDict[odabir].vrijednost.inverz().toString());
			odnosiForma1.dodajSpremljeniOdnos(spremljeniOdnos);
		}
		</script>
</html>
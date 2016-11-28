<!DOCTYPE html>
<html>
<head>
	<title><?php echo $data['title']; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-2-sm"></div>
			<div class="col-8-sm"><h1>PREGLED MATRICA</h1></div>
			<div class="col-2-sm"></div>
		</div>

		<div class="row">
			<div class="col-2-sm"></div>
			<div class="col-8-sm">
				<div class="table-responsive">
				<table class="table">
				<?php if(count($data['matrice']) > 0):?>
						<?php $i = 1; ?>
					<?php foreach($data['matrice'] as $matrica): ?>
						<?php echo "<h3>$i. Cilj: " . $matrica->getCilj() . "</h3></br>"; ?>
						<?php $matrica->nacrtaj(); ?>
						<?php echo "<p> Datum kreiranja: " . $matrica->getDatumKreiranja() . "</p>"; ?>
						<?php echo "<button type='button' name='btnPregledMatrice".$matrica->getId()."' id='btnPregledMatrice'" . $matrica->getId() . "' onclick='btnPregledMatrice_onClick(this)'>Pregled matrice</button>"; ?>
						<?php echo "<button type='button' name='btnBrisiMatricu".$matrica->getId()."' id='btnBrisiMatricu".$matrica->getId(). "' onclick='btnBrisiMatricu_onClick(this)'>Brisi matricu</button>"; ?>
						<?php echo "<hr>"; ?>
						<?php $i++; ?>
					<?php endforeach; ?>
				<?php else: ?>
					<?php echo "Nema rezultata!</br>"; ?>
				<?php endif; ?>
				</table>
			<div class="col-2-sm"></div>
			</div>
			</div>
		</div>


	<script type="text/javascript">
 		function btnPregledMatrice_onClick(el)
 		{
 			var id = el.name.replace("btnPregledMatrice", "");
 			window.location.assign("http://www.tvolaric.com/fahp/?url=Korisnik/pregledMatrice/" + id);
 		}

 		function btnBrisiMatricu_onClick(el)
 		{
		    	if(confirm("Jeste li sigurni da želite obrisati matricu?"))
		    	{
		    		var id = el.id.replace("btnBrisiMatricu", "");
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
					xhttp.responseText // return from your php;
					}
					};
					xhttp.open("GET", "http://www.tvolaric.com/fahp/brisiMatricu.php?id="+id, true);
					xhttp.send();

					setTimeout(function()
					{
						window.location.reload();
					},
					200);
		    	}
 		}
	</script>
</body>
</html>
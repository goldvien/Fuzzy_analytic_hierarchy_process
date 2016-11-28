<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $data['title']; ?></title><!-- Latest compiled and minified CSS -->
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
			<div class="col-8-sm">
				<h1><?php echo $data['title']; ?></h1>
			</div>
			<div class="col-2-sm"></div>
		</div>

		<div class="row">
			<div class="col-2-sm"></div>
			<div class="col-8-sm">
				<button type='button' name="btnPostavkeProfila<?php echo $_SESSION['id']; ?>" id='btnPostavkeProfila' onclick='btnPostavkeProfila_onClick(this)'>POSTAVKE PROFILA</button></br></br>
				<button type='button' name='btnPregledMatrica' id='btnPregledMatrica' onclick='btnPregledMatrica_onClick(this)'>PREGLED MATRICA</button></br></br>
				<button type='button' name='btnUnosMatrice' id='btnUnosMatrice' onclick='btnUnosMatrice_onClick(this)'>UNOS MATRICE</button></br></br>
			</div>
			<div class="col-2-sm"></div>
		</div>
	</div>

	<script type="text/javascript">
		function btnPostavkeProfila_onClick(el)
		{
			var id_korisnika = el.id.replace("btnPostavkeProfila", "");
			window.location.assign("http://www.tvolaric.com/fahp/?url=Korisnik/postavkeProfila/" + id_korisnika);
		}

		function btnPregledMatrica_onClick(el)
		{
			window.location.assign("http://www.tvolaric.com/fahp/?url=Korisnik/pregledMatrica/");
		}

		function btnUnosMatrice_onClick(el)
		{
			window.location.assign("http://www.tvolaric.com/fahp/?url=Korisnik/unosMatrice/");
		}
	</script>
</body>
</html>
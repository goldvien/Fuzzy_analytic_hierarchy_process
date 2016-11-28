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
				<?php if(count($data['korisnici']) > 0): ?>
					<table style="border: 1px solid black;">
					<tr>
						<td style="<?php echo $data['cellStyle']; ?>">#</td>
						<td style="<?php echo $data['cellStyle']; ?>">IME</td>
						<td style="<?php echo $data['cellStyle']; ?>">PREZIME</td>
						<td style="<?php echo $data['cellStyle']; ?>">E-MAIL</td>
						<td style="<?php echo $data['cellStyle']; ?>">USERNAME</td>
						<td style="<?php echo $data['cellStyle']; ?>">PASSWORD</td>
						<td style="<?php echo $data['cellStyle']; ?>">PRIVILEGIJE</td>
					</tr>
					<?php $i=1; ?>
					<?php foreach($data['korisnici'] as $korisnik): ?>
						<tr>
							<td style="<?php echo $data['cellStyle']; ?>"><?php echo $i; ?></td>
							<td style="<?php echo $data['cellStyle']; ?>"><?php echo $korisnik->getIme(); ?></td>
							<td style="<?php echo $data['cellStyle']; ?>"><?php echo $korisnik->getPrezime(); ?></td>
							<td style="<?php echo $data['cellStyle']; ?>"><?php echo $korisnik->getEmail(); ?></td>
							<td style="<?php echo $data['cellStyle']; ?>"><?php echo $korisnik->getUsername(); ?></td>
							<td style="<?php echo $data['cellStyle']; ?>"><?php echo $korisnik->getPassword(); ?></td>
							<td style="<?php echo $data['cellStyle']; ?>"><?php echo $korisnik->getPrivilegije(); ?></td>
							<td style="<?php echo $data['cellStyle']; ?>">
								<button type='button' name="btnObrisiKorisnika<?php echo $korisnik->getId(); ?>" onclick='btnObrisiKorisnika_onClick(this)'>
									OBRIŠI KORISNIKA
								</button>
							</td>
							<td style="<?php echo $data['cellStyle']; ?>">
								<button type='button' name="btnIzmjeniKorisnika<?php echo $korisnik->getId(); ?>" onclick='btnIzmjeniKorisnika(this)'>
									IZMJENI KORISNIKA
								</button>
							</td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
					</table>
				<?php else: ?>
					<?php echo "Nema rezultata!"; ?>
				<?php endif; ?>
			</div>
			<div class="col-2-sm"></div>
		</div>
	</div>

	</br>
	</br>
	<button type='button' name='btnDodajKorisnika' onclick='btnDodajKorisnika_onClick(this)'>DODAJ KORISNIKA</button>

	<script type="text/javascript">
		function btnObrisiKorisnika_onClick(el)
		{
			var id = el.name.replace("btnObrisiKorisnika", "");
			window.location.assign("http://www.tvolaric.com/fahp/?url=Admin/brisiKorisnika/" + id);
		}

		function btnDodajKorisnika_onClick(el)
		{
			window.location.assign("http://www.tvolaric.com/fahp/?url=Admin/dodajKorisnika");
		}

		function btnIzmjeniKorisnika_onClick(el)
		{
			var id = el.name.replace("btnIzmjeniKorisnika", "");
			window.location.assign("http://www.tvolaric.com/fahp/?url=Admin/izmjeniKorisnika/" + id);
		}
	</script>
</body>
</html>
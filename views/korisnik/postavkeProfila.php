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
			<div class="col-8-sm">
				<form method="POST" action="http://www.tvolaric.com/fahp/?url=Korisnik/postavkeProfila">
					<table>
						<tr>
							<td>Ime: </td>
							<td><input type='text' name='ime' value="<?php echo $data['ime']; ?>"/></td>
						</tr>
						<tr>
							<td>Prezime:</td>
							<td><input type='text' name='prezime' value="<?php echo $data['prezime']; ?>"/></td>
						</tr>
						<tr>
							<td>E-mail:</td>
							<td><input type='text' name='email' value="<?php echo $data['email']; ?>"/></td>
						</tr>
						<tr>
							<td>Korisničko ime: </td>
							<td><input type='text' name='username' value="<?php echo $data['username']; ?>"/></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type='password' name='password' value="<?php echo $data['password']; ?>"/></td>
						</tr>
						<tr>
							<td>Ponovi password:</td>
							<td><input type='password' name='rePassword' value="<?php echo $data['rePassword']; ?>"/></td>
						</tr>
						<tr>
							<td><input type="submit" name="btnSubmit" value="Izmjeni"/></td>
						</tr>
						<tr>
							<td colspan="2"><p style="<?php echo $data['errorStyle']; ?>"><?php echo $data['errorMessage']; ?></p></td>
						</tr>
					</table>
				</form>
				<button type='button' name='btnNazadNaPocetnu' onclick='btnNazadNaPocetnu_onClick()'>NATRAG NA POCETNU</button>
				</div>
	<div class="col-2-sm"></div>
	</div>
	</div>
	<script type="text/javascript">
		function btnNazadNaPocetnu_onClick()
		{
			window.location.assign('http://www.tvolaric.com/fahp/?url=Korisnik/index');
		}
	</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo  $data['title']; ?></title>
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
				<form method="POST" action="?url=Korisnik/login">
					<table>
						<tr>
							<td>Korisničko ime:</td>
							<td><input type="text" name="username" value="<?php echo $data['username']; ?>" /></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type="password" name="password" value="<?php echo $data['password']; ?>"/></td>
						</tr>
						<tr>
							<td><input type="submit" name="btnSubmit" value="Log in"</td>
						</tr>
						<tr>
							<td colspan="2"><p style="<?php echo $data['errorStyle']; ?>"><?php echo $data['errorMessage']; ?></p></td>
						</tr>
					</table>
				</form>
			</div>
			<div class="col-2-sm"></div>
		</div>
	</div>
</body>
</html>
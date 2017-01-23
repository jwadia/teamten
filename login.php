<?php
session_start();
if ($_SESSION['adminloggedin'] == true) {
	die(header('Location: admin/index.php'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Sign In</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<br />
<div class="container">
	<div class="vertical-offset-100">
		<div class="col-md-4 col-md-offset-4">
		<?php
		$status = $_GET['action'];
		if ($status == 'incorrect_login') {
			echo '
			<div class="alert alert-danger fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> Wrong Credentials!
			</div>
			';
		}
		?>
			<div class="panel panel-default vertical-center">
			<div class="panel-heading">
			<center><b> Admin Sign In </b></center>
			</div>
			<div class="panel-body"> 
			<form action="lib/login.php" method="POST">
				<div class="forum-group">
					<input type="text" class="form-control" id="username" name="username"  placeholder="Username">
				</div>
				<div class="forum-group" style="padding-top: 10px;">
					<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				</div>
				<br />
				<div class="forum-group">
					<input type="submit" id="submit" class="btn btn-lg btn-success btn-block" value="Log In"/>
				</div>
			</form>
			</div>
			</div>
		</div>
		<div class="col-sm-4">
		</div>
	</div>
</div>
</body>
</html>
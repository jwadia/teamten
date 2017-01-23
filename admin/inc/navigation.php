<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/navbar.css?v=<?=time();?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		
		<title> Admin Dashboard </title>
		<meta name="description" content="">
	</head>
	<body>
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<!-- LOGO -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="index.php" class="navbar-brand">ADMIN</a>
				</div>
				<!--MENU ITEMS-->
				<div class="collapse navbar-collapse" id="mainNavBar">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Dashboard</a></li>
						<li><a href="students.php">Manage Students</a></li>
						<li><a href="tasks.php">Manage Tasks</a></li>
						<li><a data-toggle="modal" href="#url">My Url</a></li>
						<?php
						if (($_SESSION['rank']) == "5") {
							echo '
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="/admin/dashboard.php">Dashboard</a></li>
							</ul>
						</li>
						';	
						}
						?>
					</ul>
					
					<!-- RIGHT ALLIGN-->
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, Admin <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="libs/logout.php">Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
		
		
<!-- Modal -->
<div id="url" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Your Custom URL</h4>
</div>
<div class="modal-body">
<p>http://school.jehanwadia.ca/team10/?id=<?php echo $_SESSION['id'] ?></p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>
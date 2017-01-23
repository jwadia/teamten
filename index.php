<?php
include "inc/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Select</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css?v=<?php date(s); ?> ">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<br />
<div class="container">
	<div class="row">
		<?php
			$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id']));
			$sql = "SELECT * FROM Students WHERE TID = '$id'";
			$result = mysqli_query($con, $sql);

			if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			echo '
			<div class="col-sm-4">
			<a href="view.php?id='.$row['ID'].'" class="thumbnail" style="min-height:400px">
				<img class="img-rounded img-responsive" src="admin/uploads/'.$row['Image'].'" style="max-height:400px; min-height: 400px;"></img>
				<h3 style="color: black; text-align: center;">'.$row['Name'].'</h3>
			</a>
			</div>
			';
			}
			} else {
			echo '
			<div class="container" style="padding-top: 125px">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading"><center>Select Teacher</center></div>
					<div class="panel-body">
					<center>
					<form method="GET">
						<div class="form-group">
						<input type="text" name="id" class="form-control" id="id">
						</div>
						<button type="submit" class="btn btn-default">Enter</button>
					</form>
					</center>
					</div>
				</div>
			</div>
			</div>
			';
			}

		?>
	</div>	
</div>
</body>
</html>
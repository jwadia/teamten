<?php
session_start();
if ($_SESSION['adminloggedin'] == false) {
	die(header('Location: ../login.php'));
}
include "inc/navigation.php";
include "inc/database.php";

$id = $_GET['id'];
?>
<link rel="stylesheet" href="css/view.css?v=<?=time();?>">
<div class="container">
<h2>Edit Schedule</h2>
  <ul class="nav nav-tabs" id="tabs">
  <?php
	$sql = "SELECT * FROM Schedule WHERE UserID = '$id'";
	$result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);
	$count -= 5;
	
	$sql = "SELECT * FROM Schedule WHERE UserID = '$id' LIMIT $count,5";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo '<li><a data-toggle="tab" href="#'.$row['Date'].'">'.$row['Date'].'</a></li>';
    }
} 
  ?>
  </ul>
  <div class="tab-content">
  <?php
	$sql9 = "SELECT * FROM Schedule WHERE UserID = '$id' LIMIT $count,5";
	$result9 = mysqli_query($con, $sql9);
	if (mysqli_num_rows($result9) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result9)) {
		$ID = $row['ID'];
		$date = $row['Date'];
		$date2 = $date;
		
		echo '
		<div id="'.$row['Date'].'" class="tab-pane fade in">
		<h3>'.$row['Date'].'</h3>
		<div class="jumbotron container">
		<center>
		<div class="col-sm-4">
		<h1> First </h1>
		<br>
		';
			$sql = "SELECT * FROM Scheduled_Tasks WHERE UserID = '$id' AND Status = '1' AND Date = '$date' ORDER BY DivID ASC LIMIT 1";
			$result = mysqli_query($con, $sql);
			if ($row = mysqli_fetch_row($result)) {
				$tid = $row[2];
				$sql2 = "SELECT * FROM Tasks WHERE ID = '$tid'";
				$result2 = mysqli_query($con, $sql2);
				if ($row2 = mysqli_fetch_row($result2)) {
					echo '<div class="dropzone" id="drop-1" ondragover="allowDrop(event)" ondrop="drop'.$ID.'(event)"><div class="wrapper"><a href="libs/del.php?id='.$row2[0].'&uid='.$_GET['id'].'&date='.$row[4].'"><span class="glyphicon glyphicon-remove-sign"></span></a></div><img id="'.chr(rand(64, 90)) . chr(rand(64, 90)) . $row[2].'"  src="uploads/'.$row2[3].'" width="200px" height="200px" dragable="true" ondragstart="drag(event)"></img></div>';
				}
			} else {
				echo '<div class="dropzone" id="drop-1" ondragover="allowDrop(event)" ondrop="drop'.$ID.'(event)"></div>';
			}
		echo '
		</div>
		<div class="col-sm-8">
		<h1> Then </h1>
		<br>
		<div class="row">
		';
			$sql = "SELECT * FROM Scheduled_Tasks WHERE UserID = '$id' AND Status = '1' AND Date = '$date' ORDER BY DivID ASC LIMIT 1,100";
			$result = mysqli_query($con, $sql);
			$count = mysqli_num_rows($result);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
				$tid = $row['TaskID']; 
				$sql2 = "SELECT * FROM Tasks WHERE ID = '$tid'";
				$result2 = mysqli_query($con, $sql2);
				if ($row2 = mysqli_fetch_row($result2)) {
					echo '<div class="col-sm-4 dropzone" id="'.$row['DivID'].'" ondragover="allowDrop(event)" ondrop="drop'.$ID.'(event)"><div class="wrapper"><a href="libs/del.php?id='.$row2[0].'&uid='.$_GET['id'].'"><span class="glyphicon glyphicon-remove-sign"></span></a></div><img id="'.chr(rand(64, 90)) . chr(rand(64, 90)) . $row[2].'"  src="uploads/'.$row2[3].'" width="200px" height="200px" dragable="true" ondragstart="drag(event)"></img></div>'; 
				}
				}
			} else {
				echo '<div class="col-sm-4 dropzone" id="drop-2" ondragover="allowDrop(event)" ondrop="drop'.$ID.'(event)"></div><div class="col-sm-4 dropzone" id="drop-3" ondragover="allowDrop(event)" ondrop="drop'.$ID.'(event)"></div><div class="col-sm-4 dropzone" id="drop-4" ondragover="allowDrop(event)" ondrop="drop'.$ID.'(event)"></div><div class="col-sm-4 dropzone" id="drop-5" ondragover="allowDrop(event)" ondrop="drop'.$ID.'(event)"></div>';
			}
			for ($x = $count; $x < 4; $x++) {
				if ($count <> 0) {
				echo '<div class="col-sm-4 dropzone" id="drop-'.rand(1, 100).'" ondragover="allowDrop(event)" ondrop="drop'.$ID.'(event)"></div>';
				}
	
		$date = explode('-', $date);
		$date = implode('p', $date);		}
		echo '
		</div>
		</div>
				</div>
		</center>
		 <div class="jumbotron container">
		 ';
			$sql = "SELECT * FROM Tasks";
			$result = mysqli_query($con, $sql);

			if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			$id666 = $row['ID'];
			$sql5 = "SELECT * FROM Scheduled_Tasks WHERE Date = '$date2' AND Status = '1' AND TaskID = '$id666'";
			$result5 = mysqli_query($con, $sql5);
			if (mysqli_num_rows($result5) == 0){
			echo '
			<img id="'.chr(rand(64, 90)) . chr(rand(64, 90)) . $row['ID'].'" src="uploads/'.$row['Image'].'" width="200px" height="200px" dragable="true" ondragstart="drag(event)"></img>
			';
			}
			
			}
			} else {
			echo "0 results";
			}

		echo "
		<div id='placeholder'></div>
		</div>
		</div>
<script>
var dropzoneId;
var old = {};
function drag(e) {
e.dataTransfer.setData('Text', e.target.id);
}
function allowDrop(e) {
if (e.target == '[object HTMLDivElement]') {
e.preventDefault();
}
}
function drop{$ID}(e) {	
dragItem = e.dataTransfer.getData('Text');
if (old[dragItem]) {	
} else {
old[dragItem] = document.getElementById(dragItem).parentNode.id;
}
if (old[dragItem] == ''){
	old[dragItem] = 'placeholder';
}
if (e.target == '[object HTMLDivElement]') {
var data = {};
var id = {$_GET['id']};
var date = '{$date}';
e.preventDefault();
e.target.innerHTML += '<div class=\"wrapper\"><a href=\"lib/del.php?id=' + dragItem + '&uid=' + id + '\"><span class=\"glyphicon glyphicon-remove-sign\"></span></a></div>';
e.target.appendChild(document.getElementById(dragItem));
data['task'] = dragItem;
document.getElementById(old[dragItem]).innerHTML = '';
old[dragItem] = e.target.id;


data['div'] = e.target.id;
data['id'] = id;
data['date'] = date;

$.ajax({
url: 'http://school.jehanwadia.ca/team10/admin/libs/change.php',
type: 'POST',
data: data,
success: function(response) {
	console.log(response);
}
});
}
}
</script>
		";
    }
	}
  ?>
</div>
<script>
$('#tabs a').click(function(e) {
  e.preventDefault();
  $(this).tab('show');
});

// store the currently selected tab in the hash value
$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
  var id = $(e.target).attr("href").substr(1);
  window.location.hash = id;
});

// on load of the page: switch to the currently selected tab
if (window.location.hash)  {
var hash = window.location.hash;
}
$('#tabs a[href="' + hash + '"]').tab('show');
</script>
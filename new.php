<?php
include "inc/database.php";

$uid = addslashes($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Schedule</title>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/view.css?v=<?=time();?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
	<script src="jquery.ui.touch-punch.js"></script>
</head>
<body>
<div class="container">
	<div class="vertical-offset-50">
		<div class="panel panel-default"> <div class="panel-body">
		<div class="wrapper"><button class="btn btn-link" onclick="add()"><span class="glyphicon glyphicon-plus-sign"></span></button></div>
		
		<div class="col-sm-4">
		
		<h1 id="firsttext"> First </h1>
		
		<br>
		<?php
			$date = date('Y-m-d');
			$sql = "SELECT * FROM Scheduled_Tasks WHERE UserID = '$uid' AND Status = '1' AND Date = '$date' ORDER BY DivID ASC LIMIT 1";
			$result = mysqli_query($con, $sql);
			if ($row = mysqli_fetch_row($result)) {
				$tid = $row[2];
				$sql2 = "SELECT * FROM Tasks WHERE ID = '$tid'";
				$result2 = mysqli_query($con, $sql2);
				if ($row2 = mysqli_fetch_row($result2)) {
					echo '<div class="dropzone" id="drop-1"><div class="wrapper"><a href="lib/del2.php?id='.$row2[0].'&uid='.$_GET['id'].'"><span class="glyphicon glyphicon-remove-sign"></span></a></div><img id="'.$row2[0].'" src="admin/uploads/'.$row2[3].'" width="200px" height="200px"></img></div>';
				}
			} else {
				echo '<div class="dropzone" id="drop-1"></div>';
			}
		?>
		</div>
		<div class="col-sm-8">
		<h1 id="thentext"> Then </h1>
		<br>
		<div class="row" id="then">
		<?php
			$sql = "SELECT * FROM Scheduled_Tasks WHERE UserID = '$uid' AND Status = '1' AND Date = '$date' ORDER BY DivID ASC LIMIT 1,100";
			$result = mysqli_query($con, $sql);
			$count = mysqli_num_rows($result);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
				$tid = $row['TaskID']; 
				$sql2 = "SELECT * FROM Tasks WHERE ID = '$tid'";
				$result2 = mysqli_query($con, $sql2);
				if ($row2 = mysqli_fetch_row($result2)) {
					echo '<div class="col-sm-4 dropzone" id="'.$row['DivID'].'"></img><div class="wrapper"><a href="lib/del.php?id='.$row2[0].'&uid='.$_GET['id'].'"><span class="glyphicon glyphicon-remove-sign"></span></a></div><img id="'.$row2[0].'" src="admin/uploads/'.$row2[3].'" width="200px" height="200px"></div>';
				}
				}
			} else {
				echo '<div class="col-sm-4 dropzone" id="drop-2"></div>';
			}
		?>
		</div>
		</div>
		
		</div>
		</div>
	<div class="panel panel-default"> <div class="panel-body">
	<div>
		<?php
			$sql = "SELECT * FROM Tasks";
			$result = mysqli_query($con, $sql);

			if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			echo '
			<img id="'.$row['ID'].'" class="img" src="admin/uploads/'.$row['Image'].'" width="200px" height="200px"></img>
			';
			}
			} else {
			echo "0 results";
			}

		  ?>
		  </div>
	</div>
		</div>
	</div>
</div>

<div id="placeholder"></div>
<script>
var dropzoneId;
var old = {};

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
function add() {
	document.getElementById('then').innerHTML += '<div class="col-sm-4 dropzone ui-droppable" id="drop-' + makeid() + '"></div>';
	sizer("then");
	drig();
}
function drag(e) {
	e.dataTransfer.setData("Text", e.target.id);
}
function allowDrop(e) {
	if (e.target == "[object HTMLDivElement]") {
		e.preventDefault();
	}
}
function drop(e) {
	dragItem = e.dataTransfer.getData("Text");
	if (old[dragItem]) {
		
	} else {
		old[dragItem] = document.getElementById(dragItem).parentNode.id;
	}
	if (old[dragItem] == ''){
		old[dragItem] = 'placeholder';
	}
	if (e.target == "[object HTMLDivElement]") {
		var data = {};
		var id = '<?php echo $_GET['id']; ?>';
		e.preventDefault();
		e.target.innerHTML += '<div class="wrapper"><a href="lib/del.php?id=' + dragItem + '&uid=<?php echo $_GET['id']; ?>"><span class="glyphicon glyphicon-remove-sign"></span></a></div>';
		e.target.appendChild(document.getElementById(dragItem));
		
		console.log(document.getElementById(old[dragItem]).innerHTML);
		document.getElementById(old[dragItem]).innerHTML = '';
		console.log(document.getElementById(old[dragItem]).innerHTML);
		old[dragItem] = e.target.id;
		
		data['task'] = dragItem;
		data['div'] = e.target.id;
		data['id'] = id;
		
		$.ajax({
		url: 'lib/change.php',
		type: 'POST',
		data: data,
		success: function(response) {
		}
	});
	}
	
}

function sizer(whichbox) {
       var counted = document.getElementById(whichbox).childNodes.length;
       var boxwidth = (counted - 2) * 240;
       var inPixels = boxwidth.toString().concat("px");
       document.getElementById(whichbox).style.width = inPixels;
}


sizer("then");
function drig() {
  $( function() {
    $( ".img" ).draggable();
    $( "#then>div, #drop-1" ).droppable({
      drop: function( event, ui ) {
        var transImage = document.getElementById(event.srcElement.id);
        transImage.style = "";
        var divHolder = document.getElementById(event.target.id);
        divHolder.appendChild(transImage);
		
		
		var data = {};
		var id = '<?php echo $_GET['id']; ?>';
		
		
		data['task'] = event.srcElement.id;
		data['div'] = event.target.id;
		data['id'] = id;
		
		$.ajax({
		url: 'lib/change.php',
		type: 'POST',
		data: data,
		success: function(response) {
			location.reload();
		}
        });
		
		
		
        }
        });
  });
};
drig();
</script>
</body>
</html>
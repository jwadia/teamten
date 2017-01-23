<?php
session_start();
if ($_SESSION['adminloggedin'] == false) {
	die(header('Location: ../login.php'));
}
include "inc/navigation.php";
include "inc/database.php";
?>

<div class="container">
	<div class="col-md-9">
	  <h2>Manage Tasks</h2>
	  <table class="table table-bordered">
		<thead>
		  <tr>
			<th>Name</th>
			<th>Image</th>
			<th>Description</th>
			<th>Tools</th>
		  </tr>
		</thead>
		<tbody>
		  <?php
		  	$id = $_SESSION['id'];
			$sql = "SELECT * FROM Tasks WHERE TID = '$id'";
			$result = mysqli_query($con, $sql);

			if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			echo '
			<tr>
			<td>'.$row['Name'].'</td>
			<td><center><img src="uploads/'.$row['Image'].'" class="img-responsive" height="100" width="100"></a></center></td>
			<td>'.$row['Description'].'</td>
			<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-'.$row['ID'].'">Edit Task</button></td>
			</tr>
			
			<!-- Modal -->
			<div id="edit-'.$row['ID'].'" class="modal fade" role="dialog">
			<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Edit Task</h4>
			</div>
			<div class="modal-body">
				<form action="libs/edittask.php?id='.$row['ID'].'" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="name">Task Name:</label>
					<input type="text" class="form-control" value="'.$row['Name'].'" id="name" name="name">
				</div>
				<div class="form-group">
					<label for="name">Task Description:</label>
					<input type="text" class="form-control" value="'.$row['Description'].'" id="desc" name="desc">
				</div>
				<div class="forum-group">
					<label for="image">Student Image:</label>
					<input type="file" class="form-control" id="image" name="image">
				</div>
				<br>
				<button type="submit" class="btn btn-default">Edit</button>
				<a href="libs/deltask.php?id='.$row['ID'].'" class="btn btn-default" role="button">Delete Task</a>
				</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			</div>

			</div>
			</div>
			';
			}
			} else {
			echo "0 results";
			}

		  ?>
		</tbody>
	  </table>
	</div>
	<div class="col-md-3">
		<h2>Add Task</h2>
		<div class="panel panel-default">
			<div class="panel-body">
			<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#add">Add</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Task</h4>
      </div>
      <div class="modal-body" id="body">
		<form class="ajax" action="libs/addtask.php" method="POST">
			<div class="form-group">
				<label for="name">Task Name:</label>
				<input type="text" class="form-control" id="name" name="name">
			</div>
			<div class="form-group">
				<label for="name">Task Description:</label>
				<input type="text" class="form-control" id="desc" name="desc">
				<input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>" />
			</div>
				<button type="submit" class="btn btn-default">Submit</button>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
$('form.ajax').on('submit', function() {
	var that = $(this),
		url = that.attr('action'),
		method = that.attr('method'),
		data = {};
	
	that.find('[name]').each(function(index, value) {
		var that = $(this),
			name = that.attr('name'),
			value = that.val();
			
		data[name] = value;
	});
	
	console.log(data);
	
	$.ajax({
		url: url,
		type: method,
		data: data,
		success: function(response) {
			console.log(response);
		}
	});
	document.getElementById("body").innerHTML = "<h1> Task Added! </h1>";
	return false;
});
</script>
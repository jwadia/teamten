<?php
include "../inc/database.php";

$uid = $_POST['id'];
$tid = $_POST['task'];
$did = $_POST['div'];
$date = date('Y-m-d');

$sql = "INSERT INTO Scheduled_Tasks (UserID, TaskID, DivID, Date)
VALUES ('$uid', '$tid', '$did', '$date')";



if (mysqli_query($con, $sql)) {} 

$sql = "SELECT * FROM Scheduled_Tasks WHERE UserID = '$uid' AND TaskID = '$tid' AND Status = '1'";
$result = mysqli_query($con, $sql);
if ($row = mysqli_fetch_row($result)) {
	if (mysqli_num_rows($result) > 1) {
		$oldid = $row[0];
		$sql = "UPDATE Scheduled_Tasks SET Status='2' WHERE ID='$oldid'";
		if(mysqli_query($con, $sql)) {
			
		}
	}
}
?>
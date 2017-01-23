<?php
session_start();
if ($_SESSION['adminloggedin'] == false) {
	die(header('Location: ../login.php'));
}

include "../inc/database.php";

$name = mysqli_real_escape_string($con, htmlspecialchars($_POST['name']));
$id = $_POST['id'];

$sql = "INSERT INTO Students (Name, TID) VALUES ('$name', '$id')";

if (mysqli_query($con, $sql) === TRUE) {
	$sql = "SELECT * FROM Students WHERE Name = '$name'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_row($result);
	$id = $row[0];
}



$sql = "SELECT * FROM Schedule WHERE UserID = '0'";
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
$count -=5;

$sql = "SELECT * FROM Schedule WHERE UserID = '0' LIMIT $count, 5";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$date = $row['Date'];
        $sql = "INSERT INTO Schedule (Date, UserID) VALUES ('$date', '$id')";
		if (mysqli_query($con, $sql) === TRUE) {}
    }
} 
?>
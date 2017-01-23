<?php
session_start();
if ($_SESSION['adminloggedin'] == false) {
	die(header('Location: ../login.php'));
}

include "../inc/database.php";

$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id']));

$sql = "DELETE FROM Students WHERE ID = '$id'";

if (mysqli_query($con, $sql) === TRUE) {
}

die(header('Location: ../students.php'));
?>
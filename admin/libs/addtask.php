<?php
session_start();
if ($_SESSION['adminloggedin'] == false) {
	die(header('Location: ../login.php'));
}

include "../inc/database.php";

$name = mysqli_real_escape_string($con, htmlspecialchars($_POST['name']));
$desc = mysqli_real_escape_string($con, htmlspecialchars($_POST['desc']));
$id = $_POST['id'];

$sql = "INSERT INTO Tasks (Name, Description, TID) VALUES ('$name', '$desc', '$id')";

if (mysqli_query($con, $sql) === TRUE) {
}
?>
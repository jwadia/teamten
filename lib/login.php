<?php
session_start();
if ($_SESSION['adminloggedin'] == true) {
	die(header('Location: ../admin/index.php'));
}
include "../inc/database.php";

$password = mysqli_real_escape_string($con, htmlspecialchars($_POST['password']));
$username = mysqli_real_escape_string($con, htmlspecialchars($_POST['username']));

$select_user = ("SELECT * FROM Users WHERE Username = '$username'");
$result = $con->query($select_user);
$userdata = mysqli_fetch_row($result);

if ($username == $userdata[1]) {
	if (password_verify($password, $userdata[2])) {
		$_SESSION['adminloggedin'] = true;
		$_SESSION['username'] = $userdata[1];
		$_SESSION['id'] = $userdata[0];
		die(header('Location: ../admin/index.php'));
	} else {
		die(header('Location: ../login.php?action=incorrect_login'));
	}
} else {
	die(header('Location: ../login.php?action=incorrect_login'));
}
?>
<?php
session_start();
if ($_SESSION['adminloggedin'] == false) {
	die(header('Location: ../login.php'));
}
include "../inc/database.php"; 

$name = mysqli_real_escape_string($con, htmlspecialchars($_POST['name']));
$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id']));

if(isset($_FILES['image'])) {
	$file = $_FILES['image'];
	
	//Filedata
	$file_name = $file['name'];
	$file_tmp = $file['tmp_name'];
	$file_size = $file['size'];
	$file_error = $file['error'];
	
	//File Whitelist
	$file_ext = explode('.', $file_name);
	$file_ext = strtolower(end($file_ext));
	
	$allowed = array('png', 'jpg', 'jpeg', 'gif');
	if(in_array($file_ext, $allowed)) {
		if($file_error === 0) {
			$file_name_new = uniqid('', true) . '.' . $file_ext;
			$file_dest = '../uploads/' . $file_name_new;
			
			if(move_uploaded_file($file_tmp, $file_dest)){
				$filename = $file_name_new;
			} else {
			}
		} else {
		}
	} else {
	}
}

if(isset($filename)) {
	$sql = "UPDATE Students SET Name='$name', Image = '$filename' WHERE id='$id'";
} else {
	$sql = "UPDATE Students SET Name='$name' WHERE id='$id'";
}

if (mysqli_query($con, $sql)) {
    die(header('Location: ../students.php'));
} 
?>
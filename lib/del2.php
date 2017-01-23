<?php
include "../inc/database.php";
$id = $_GET['id'];
$uid = $_GET['uid'];

$sql = "UPDATE Scheduled_Tasks SET Status='2' WHERE TaskID='$id' AND Status='1'";

if (mysqli_query($con, $sql)) {
} 

die(header("Location: ../mobile.php?id={$uid}"));
?>
<?php
include "../inc/database.php";
$id = $_GET['id'];
$uid = $_GET['uid'];
$date = $_GET['date'];

$sql = "UPDATE Scheduled_Tasks SET Status='2' WHERE TaskID='$id' AND Status='1' AND Date = '$date'";

if (mysqli_query($con, $sql)) {
} 

die(header("Location: ../edit.php?id={$uid}"));
?>
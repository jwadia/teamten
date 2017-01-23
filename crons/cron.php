<?php
include "../inc/database.php";

$week[0] = date('Y-m-d', strtotime("+3 days"));

for($x = 1; $x <= 4; $x++) {
	$y = $x + 3;
	$week[$x] = date('Y-m-d', strtotime("+$y days"));
}

$sql = "SELECT * FROM Students";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    $id = $row['ID'];
	foreach ($week as $value) {
	$sql = "INSERT INTO Schedule (Date, UserID)
	VALUES ('$value', '$id')";
	
	if (mysqli_query($con, $sql)) {
	} 
	}
    }
} else {
    echo "0 results";
}
?>
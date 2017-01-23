<?php
date_default_timezone_set('America/Toronto');
$myhost = "localhost";
$myuser = "school_db";
$mypass = "Heya1234";
$mydb = "school_db";
$con = mysqli_connect($myhost, $myuser, $mypass, $mydb);
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die; // No point in running past this point with no database.
}
?>
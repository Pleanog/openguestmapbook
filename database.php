<?php
	$host = ""; 			// host name 
	$db_username = ""; 		// MySQL username 
	$db_password = ""; 		// MySQL password 
	$db_name = "";			// database name 

	$mysqli_connection = mysqli_connect($host, $db_username, $db_password, $db_name)or die("Cannot connect to database."); 
?>
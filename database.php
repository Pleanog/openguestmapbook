<?php
	$host = "91.204.46.200:3306"; 			// host name 
	$db_username = "k146591_ogmb"; 		// MySQL username 
	$db_password = "Flvy!486"; // MySQL password 
	$db_name = "k146591_ogmb";			// database name 

	$mysqli_connection = mysqli_connect($host, $db_username, $db_password, $db_name)or die("Cannot connect to database."); 
?>
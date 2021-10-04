<?php 
	$servername = "localhost";
	$username = "id12264139_tunjicmsblogusername";
	$password = "#AdetunjiMay29.";
	$database = "id12264139_tunjicmsblog";

	//Create connection
	$conn = new mysqli($servername,$username,$password,$database);
	if ($conn->connect_error) {
		die("Connection failed: ".$conn->connect_error);
	}
	echo "Database connected successfully";
 ?>
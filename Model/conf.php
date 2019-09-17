<?php  

	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "admin";
	
	$conf = mysqli_connect($host,$user,$password,$db);
	if ($conf) {
		session_start();
	}

?>
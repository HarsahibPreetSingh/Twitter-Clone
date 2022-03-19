<?php 
	$dsn = 'mysql:host=localhost; dbname=tweety';
	$user = 'root';
	$password = '';
 

	try{
		$pdo = new PDO($dsn, $user, $password);
	}catch(PDOException $e){
		echo 'connection error! ' . $e;
	}	

  
//	$hostservername = "localhost"; //use localhost:<port_number> if connection does not work
//	$username = "root";
//	$password = "";
//	$dbname = "tweety";
//
//	$pdo = new mysqli($hostservername, $username, $password, $dbname);
//
//	if ($pdo->connect_error) {
//		die("Nooooooooo<br>" . $dbconnection->connect_error);
//	}
//	else {
//		//echo "<h1>Connected!</h1>";
//	}
?>

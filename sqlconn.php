<?php
$host = "108.181.197.185";
$user = "admin";
$pass = "krLmNvdT";
$dbname = "dbmanagement";

try {
	$connect = new PDO("mysql:host=$host;port=19999;dbname=$dbname", $user, $pass);
	if($connect){
		echo 'connected';
	}
	}
	catch(PDOException $e) {

	echo 'ERROR: ' . $e->getMessage();
	}
			
?>
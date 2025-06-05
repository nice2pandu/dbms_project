<?php
$host = "108.181.197.185";
$user = "admin";
$pass = "krLmNvdT";
$dbname = "dbmanagement";

try {
    $connect = new PDO("mysql:host=$host;port=19999;dbname=$dbname", $user, $pass);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}		
?>
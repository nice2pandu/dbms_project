<?php
include 'db.php';
session_start();

$data = [];

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_session_id'])) {
    $data['output'] = 'logout';
    echo json_encode($data);
    exit;
}

$today = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$present = clone $today;
$present->modify('-1 days');
$presentFormatted = $present->format('Y-m-d');

// Secure query
$query = "SELECT user_session_id, expeiry_date FROM user_login WHERE id = :id";
$stmt = $connect->prepare($query);
$stmt->execute([':id' => $_SESSION['user_id']]);

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $expdate = new DateTime($row['expeiry_date']);
    $expdateFormatted = $expdate->format('Y-m-d');

    if ($_SESSION['user_session_id'] != $row['user_session_id'] || $expdateFormatted <= $presentFormatted) {
        $data['output'] = 'logout';
        $data['expdate1'] = $expdateFormatted;
    } else {
		$data['output'] = 'login';
        //$data['expdate2'] = $expdateFormatted;
    }
} else {
    $data['output'] = 'logout'; // No user found
}

echo json_encode($data);
$connect = null;

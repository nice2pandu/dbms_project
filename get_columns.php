<?php
// Include database connection
require_once('db.php'); // Adjust the path accordingly

if (isset($_POST['selectdata'])) {
    $tableName = $_POST['selectdata'];
    $columns = [];

    // Query to get column names for the selected table
    $query = "DESCRIBE $tableName";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $columns[] = $row['Field'];
        }
        echo json_encode(['columns' => $columns]);
    } else {
        echo json_encode(['error' => 'Error fetching column names.']);
    }
} else {
    echo json_encode(['error' => 'No table name provided.']);
}
?>

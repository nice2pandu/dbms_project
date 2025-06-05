
<?php
include 'db.php';

$db_name = isset($_POST['selectdata']) ? $_POST['selectdata'] : '';
$mobile = $_POST['mobile'] ?? '';
$name = $_POST['name'] ?? '';
$altno = $_POST['altno'] ?? '';
$address = $_POST['address'] ?? '';
$pincode = $_POST['pincode'] ?? '';

list($dbOnly, $tableOnly) = explode('.', str_replace('`', '', $db_name));
$full_table_name = "`$dbOnly`.`$tableOnly`";

if (!empty($mobile)) {
    $numbers = implode(',', preg_split('/\s+/', trim($mobile)));
    if ($db_name === "ghmc2020.`ghmc`" || $db_name == "advgujarat.`data`") {
$query = "SELECT * FROM $full_table_name WHERE MATCH(mobile) AGAINST('$numbers' IN BOOLEAN MODE)";
    } else {
        $query = "SELECT * FROM $full_table_name WHERE mobile IN ($numbers)";
    }
}
 elseif ($name && $address) {
    $query = "SELECT *, 
        MATCH(cname) AGAINST('\"$name\"' IN NATURAL LANGUAGE MODE) AS a_a,
        MATCH(ladd) AGAINST('*$address*' IN BOOLEAN MODE) AS a_b
        FROM $full_table_name
        WHERE MATCH(cname) AGAINST('+$name*' IN BOOLEAN MODE)
        AND MATCH(ladd) AGAINST('*$address*' IN BOOLEAN MODE)
        ORDER BY (a_a + a_b) DESC
        LIMIT 200000";
}
elseif ($name && $pincode) {
    $query = "SELECT *, 
        MATCH(cname) AGAINST('\"$name\"' IN NATURAL LANGUAGE MODE) AS a_a,
        MATCH(ladd) AGAINST('*$pincode*' IN BOOLEAN MODE) AS a_b
        FROM $full_table_name
        WHERE MATCH(cname) AGAINST('+$name*' IN BOOLEAN MODE)
        AND MATCH(ladd) AGAINST('*$pincode*' IN BOOLEAN MODE)
        ORDER BY (a_a + a_b) DESC
        LIMIT 200000";
}
elseif ($address && $pincode) {
    $query = "SELECT *, 
        MATCH(ladd) AGAINST('\"$address\"' IN NATURAL LANGUAGE MODE) AS a_a,
        MATCH(ladd) AGAINST('*$pincode*' IN BOOLEAN MODE) AS a_b
        FROM $full_table_name
        WHERE MATCH(ladd) AGAINST('+$address*' IN BOOLEAN MODE)
        AND MATCH(ladd) AGAINST('*$pincode*' IN BOOLEAN MODE)
        ORDER BY (a_a + a_b) DESC
        LIMIT 200000";
}

$columns_query = "SHOW COLUMNS FROM $full_table_name";
$columns_result = $connect->query($columns_query);
if (!$columns_result) {
    echo json_encode(['error' => 'Failed to fetch columns', 'details' => $connect->errorInfo()]);
    exit;
}

$columns = [];
while ($col = $columns_result->fetch(PDO::FETCH_ASSOC)) {
    $columns[] = $col['Field'];
}

$result = $connect->query($query);
if (!$result) {
    echo json_encode(['error' => 'Failed to fetch data', 'details' => $connect->errorInfo()]);
    exit;
}

$data = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

$response = [
    'columns' => $columns,
    'data' => $data,
];

echo json_encode($response);
?>




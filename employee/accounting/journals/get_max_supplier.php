<?php
require_once('../../../config.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$databaseName = "alscdb"; 
$tableName = "supplier_list"; 

$query = "SHOW TABLE STATUS LIKE '$tableName'";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $maxId = $row['Auto_increment'] - 1;
    echo $maxId;
} else {
    echo 'Error';
}
?>

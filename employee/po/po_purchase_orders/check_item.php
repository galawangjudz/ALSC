<?php
require_once('./../../../config.php');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$itemValue = $_GET['item'];


$sql = "SELECT COUNT(*) as count FROM item_list WHERE name = '$itemValue'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row['count'];
    
    // Send JSON response
    echo json_encode(['exists' => $count > 0]);
} else {
    // Handle database error
    echo json_encode(['exists' => false]);
}

?>

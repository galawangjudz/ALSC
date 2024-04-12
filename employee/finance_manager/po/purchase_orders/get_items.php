<?php
require_once('./../../../config.php');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['supplier_id'])) {
    $supplier_id = $_POST['supplier_id'];

    $items = array();
    
    $item_qry = $conn->query("SELECT * FROM `item_list` WHERE supplier_id = $supplier_id");
    
    while ($row = $item_qry->fetch_assoc()) {
        $items[] = array(
            'id' => $row['id'],
            'name' => $row['name']
        );
    }
    
    echo json_encode($items);
}

$conn->close();
?>

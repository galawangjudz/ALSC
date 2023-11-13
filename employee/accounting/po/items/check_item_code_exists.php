<?php
require_once('../../../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['item_code'])) {
    $itemCode = $_GET['item_code'];


    $query = $conn->query("SELECT COUNT(*) AS item_code_exists FROM item_list WHERE item_code = '$itemCode'");

    if ($query) {
        $result = $query->fetch_assoc();
        $itemCodeExists = $result['item_code_exists'];


        $response = ['status' => 'success', 'itemCodeExists' => $itemCodeExists];
        echo json_encode($response);
        exit;
    } else {

        $response = ['status' => 'error', 'message' => 'Database query error'];
        echo json_encode($response);
        exit;
    }
} else {

    $response = ['status' => 'error', 'message' => 'Invalid or missing item_code parameter'];
    echo json_encode($response);
    exit;
}
?>

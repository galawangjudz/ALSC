<?php
require_once('./../../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['item_code'])) {
    $itemCode = $_GET['item_code'];

    // Perform a database query to check if the item_code exists
    $query = $conn->query("SELECT COUNT(*) AS item_code_exists FROM item_list WHERE item_code = '$itemCode'");

    if ($query) {
        $result = $query->fetch_assoc();
        $itemCodeExists = $result['item_code_exists'];

        // Return whether the item_code exists as JSON response
        $response = ['status' => 'success', 'itemCodeExists' => $itemCodeExists];
        echo json_encode($response);
        exit;
    } else {
        // Handle the database query error
        $response = ['status' => 'error', 'message' => 'Database query error'];
        echo json_encode($response);
        exit;
    }
} else {
    // Handle invalid or missing item_code parameter
    $response = ['status' => 'error', 'message' => 'Invalid or missing item_code parameter'];
    echo json_encode($response);
    exit;
}
?>

<?php
require_once('./../../../config.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['supplier_id'])) {
    $supplierId = $_GET['supplier_id'];
    $query = $conn->query("SELECT COUNT(item_code) AS count_item_code FROM item_list WHERE supplier_id = '$supplierId'");

    if ($query) {
        $result = $query->fetch_assoc();
        $countItemCode = $result['count_item_code'];
        $countItemCode++;
        $response = ['status' => 'success', 'count_item_code' => $countItemCode];
        echo json_encode($response);
        exit;
    } else {
        $response = ['status' => 'error', 'message' => 'Error sessshh!'];
        echo json_encode($response);
        exit;
    }
} else {
    $response = ['status' => 'error', 'message' => 'Invalid sesssh!!'];
    echo json_encode($response);
    exit;
}
?>

<?php
require_once('../../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'checkItemType') {

    $supplierId = filter_input(INPUT_POST, 'supplierId', FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("SELECT item_code FROM item_list WHERE supplier_id = ? AND type = 2");
    $stmt->bind_param('s', $supplierId);
    $stmt->execute();
    $stmt->bind_result($itemCode);

    $result = array();

    while ($stmt->fetch()) {
        $result[] = array('item_code' => $itemCode);
    }

    $stmt->close();

    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>

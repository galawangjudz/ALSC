<?php
require_once('../../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $supplierId = $_POST['supplier_id'];

    // Use prepared statement to prevent SQL injection
    $query = "SELECT i.name, i.account_code, i.item_code, i.description, s.name AS supplier_name 
              FROM item_list i
              JOIN supplier_list s ON i.supplier_id = s.id
              WHERE i.supplier_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $supplierId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $items = array();

        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        echo json_encode($items);
    } else {
        echo json_encode(array('error' => 'Error in query: ' . $conn->error));
    }

    $stmt->close();
} else {
    echo json_encode(array('error' => 'Invalid request method'));
}
?>

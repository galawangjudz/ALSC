<?php
require_once('../../../config.php');

if (isset($_GET['q'])) {
    $searchTerm = $_GET['q'];

    $query = "SELECT id, name as text FROM supplier_list WHERE status = 1 AND short_name OR name LIKE '%$searchTerm%' ORDER BY name ASC";

    $result = $conn->query($query);

    $suppliers = array();

    while ($row = $result->fetch_assoc()) {
        $suppliers[] = $row;
    }

    echo json_encode($suppliers);
}
?>

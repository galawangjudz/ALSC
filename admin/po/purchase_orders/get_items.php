<?php
require_once('./../../../config.php');
$supplierId = filter_input(INPUT_GET, "item_code", FILTER_SANITIZE_STRING);

if (empty($supplierId)) {
    die("Invalid item code.");
}

$sql = "SELECT ilist.*, o_list.unit_price, o_list.item_id, o_list.date_purchased AS recent_date_purchased
FROM `item_list` ilist
LEFT JOIN `approved_order_items` o_list ON ilist.id = o_list.item_id
WHERE supplier_id='$supplierId'
ORDER BY o_list.date_purchased DESC";
$result = mysqli_query($conn, $sql);

$items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = [
        "id" => $row['id'],
        "name" => $row['name'],
        "description" => $row['description'],
        "default_unit" => $row['default_unit']
        // "unit_price" => $row['unit_price'],
        // "item_id" => $row['item_id'],
        // "recent_date_purchased" => $row['recent_date_purchased']
    ];
}

echo json_encode($items);
?>

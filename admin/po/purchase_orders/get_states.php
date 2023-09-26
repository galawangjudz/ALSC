<?php
require_once('config.php');

$supplierId = filter_input(INPUT_GET, "item_code", FILTER_SANITIZE_STRING);


if (empty($supplierId)) {
  die("Invalid item code.");
}

$sql = "SELECT id, supplier_id, name FROM item_list WHERE supplier_id = '$supplierId'";

$result = mysqli_query($conn, $sql);

$items = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($items);

mysqli_close($conn);
?>

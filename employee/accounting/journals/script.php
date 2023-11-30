<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alscdb";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selectedPoNo = $_POST['po_no'];


$query = "SELECT * FROM approved_order_items WHERE po_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $selectedPoNo);
$stmt->execute();
$result = $stmt->get_result();


$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}


$stmt->close();
$conn->close();

echo json_encode($data);
?>

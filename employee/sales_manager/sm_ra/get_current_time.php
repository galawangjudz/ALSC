<?php
// Include your database connection code here

// Assuming you have a database connection $conn
$query = "SELECT CURRENT_TIMESTAMP() AS current_time"; // Use CURRENT_TIMESTAMP() to get the server's current time

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_time = $row["current_time"];
    echo json_encode(["current_time" => $current_time]);
} else {
    echo json_encode(["error" => "Unable to retrieve current time"]);
}
?>

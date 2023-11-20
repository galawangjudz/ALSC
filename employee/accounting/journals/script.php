<?php
// Connect to your database (replace these values with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alscdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected po_no from the AJAX request
$selectedPoNo = $_POST['po_no'];

// Perform a query to fetch data based on the selected po_no
$query = "SELECT * FROM approved_order_items WHERE po_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $selectedPoNo);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the data into an associative array
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the database connection
$stmt->close();
$conn->close();

// Return the data as a JSON response
echo json_encode($data);
?>

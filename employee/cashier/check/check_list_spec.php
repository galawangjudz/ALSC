<?php
require_once('../../../config.php');

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $query = "SELECT * FROM check_details WHERE c_num = ?";
    

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $_GET['id']);
    $stmt->execute();

    $result = $stmt->get_result();

    $checkNumbers = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    echo '<ul>';
    foreach ($checkNumbers as $row) {
        echo '<li>' . htmlspecialchars($row['check_num']) . '</li>';
    }
    echo '</ul>';

} else {
    echo json_encode(['error' => 'Invalid or missing ID parameter']);
}
?>

<?php
$conn = new mysqli(DB_SERVER,DB_USERNAME,'',DB_NAME);
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
?>
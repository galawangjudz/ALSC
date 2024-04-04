<?php
// Connect to the database.
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, '', DB_NAME);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
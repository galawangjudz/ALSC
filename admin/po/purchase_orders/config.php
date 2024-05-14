<?php
// Connect to the database.
$conn = mysqli_connect("localhost", "root", "", "alscdb");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
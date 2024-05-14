<?php
require_once('../../../config.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["invoice_no"])) {
    $invoice_no = $_POST["invoice_no"];

    $sql = "SELECT * FROM apv WHERE invoice_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $invoice_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<span class='text-danger' id='spanred'>Invoice number already exists.</span>";
    } else {
        echo "<span class='text-success' id='spangreen'>Invoice number is available.</span>";
    }

    $stmt->close();

}
?>

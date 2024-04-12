<?php

require_once('../../../config.php');

if (isset($_POST['po_id'])) {
    $poId = $_POST['po_id'];


    $query = "SELECT * FROM tbl_gr_list WHERE po_id = $poId";

    $result = $conn->query($query);

    if ($result) {
        $grDetails = array();
        while ($row = $result->fetch_assoc()) {
            $grDetails[] = $row;
        }

        echo json_encode(['gr_details' => $grDetails]);
    } else {
        echo json_encode(['error' => 'Query failed']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>

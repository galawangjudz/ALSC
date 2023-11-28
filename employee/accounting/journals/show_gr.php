<?php
require_once('../../../config.php');
if (isset($_POST['supplier_id'])) {
    $supplierId = $_POST['supplier_id'];

    $query = "SELECT po.id, gr.gr_id, gr.gr_status, po.po_no, po.date_created
    FROM tbl_gr_list gr
    LEFT JOIN po_approved_list po ON gr.po_id = po.id WHERE po.supplier_id=$supplierId and gr.gr_status=0";
              

    // $query = "SELECT pal.id as palId, pal.po_no, pal.date_created, pal.supplier_id, sl.id
    //             FROM po_approved_list AS pal
    //             INNER JOIN supplier_list AS sl ON pal.supplier_id = sl.id
    //             WHERE pal.status = 1 and sl.id=$supplierId";
    $result = $conn->query($query);

    if ($result) {
        $grData = array();
        while ($row = $result->fetch_assoc()) {
            $grData[] = $row;
        }

        echo json_encode(['gr_data' => $grData]);
    } else {
        echo json_encode(['error' => 'Query failed']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>

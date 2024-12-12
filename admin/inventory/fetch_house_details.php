<?php
header('Content-Type: application/json');
include('../../config.php'); // Ensure this path is correct and config is loaded

if (isset($_GET['house_lid'])) {
    $houseLid = $_GET['house_lid'];

    $query = "
        SELECT c_house_model, c_floor_area, c_h_price_sqm, c_remarks, c_status, c_unit_status, c_count, c_house_type
        FROM t_house
        WHERE c_lid = ?
    ";
    $stmt = odbc_prepare($conn2, $query);
    odbc_execute($stmt, [$houseLid]);

    if ($row = odbc_fetch_array($stmt)) {
        $floor_area = $row['c_floor_area'];
        $price_sqm = $row['c_h_price_sqm'];
        $hcp = $floor_area * $price_sqm;
    
        echo json_encode([
            'success' => true,
            'house_model' => $row['c_house_model'],
            'floor_area' => number_format(round($floor_area, 2), 2, '.', ','),
            'price_sqm' => number_format($price_sqm, 2, '.', ','),
            'hcp' => number_format($hcp, 2, '.', ','),
            'status' => $row['c_status'],
            'unit_status' => $row['c_unit_status'],
            'remarks' => $row['c_remarks']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No details found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

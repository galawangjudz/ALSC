<?php
include '../../config.php';

// Get POST data
$prod_code = $_POST['prod_code'] ?? '';
$prod_block = $_POST['prod_block'] ?? '';
$prod_lot = $_POST['prod_lot'] ?? '';

// Generate c_lot_lid
$prod_code_prefix = substr($prod_code, 0, 3);
$formatted_block = sprintf('%03d', $prod_block);
$formatted_lot = sprintf('%02d', $prod_lot);
$c_lot_lid = $prod_code_prefix . $formatted_block . $formatted_lot;

// Query the database
$stmt = $conn->prepare("SELECT * FROM properties 
                        JOIN property_clients 
                        ON properties.property_id = property_clients.property_id
                        WHERE c_lot_lid = ?");
$stmt->bind_param("s", $c_lot_lid);
$stmt->execute();
$result = $stmt->get_result();

$response = ['c_lot_lid' => $c_lot_lid, 'html' => ''];

if ($result && $result->num_rows > 0) {
    $html = '<table class="table table-bordered">';
    $html .= '<thead><tr>
                <th>Property ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Type</th>
                <th>Status</th>
              </tr></thead><tbody>';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $row['property_id'] . '</td>
                    <td>' . $row['last_name'] . '</td>
                    <td>' . $row['first_name'] . '</td>
                    <td>' . $row['c_type'] . '</td>
                    <td>' . $row['c_active'] . '</td>
                  </tr>';
    }
    $html .= '</tbody></table>';
    $response['html'] = $html;
} else {
    $response['html'] = '<p>No data found.</p>';
}

echo json_encode($response);
?>
